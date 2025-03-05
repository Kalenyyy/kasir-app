<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Member;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->get();
        $orders = Order::with('products', 'users')->get();
        return view('orders.index', compact('products', 'orders'));
    }

    public function showCheckout(Request $request)
    {
        // Ambil data produk dan quantity dari request
        $productIds = $request->input('product_ids', []);
        $quantities = $request->input('quantities', []);

        // Filter hanya produk dengan quantity lebih dari 0
        $checkoutProducts = [];
        foreach ($productIds as $productId) {
            if (!empty($quantities[$productId]) && $quantities[$productId] > 0) {
                $checkoutProducts[$productId] = $quantities[$productId];
            }
        }

        // Jika tidak ada produk yang valid, kembali ke halaman sebelumnya dengan pesan error
        if (empty($checkoutProducts)) {
            return redirect()->back()->with('error', 'Silakan pilih setidaknya satu produk dengan jumlah lebih dari 0.');
        }

        // Ambil detail produk dari database berdasarkan ID yang telah difilter
        $products = Product::whereIn('id', array_keys($checkoutProducts))->get();

        $totalPrice = 0;

        foreach ($products as $product) {
            $totalPrice += $product->price * ($checkoutProducts[$product->id] ?? 1);
        }

        // Return view checkout dengan data produk dan quantity
        return view('orders.checkout', compact('products', 'checkoutProducts', 'totalPrice'));
    }

    public function checkout(Request $request)
    {
        // Ambil array ID dari produk yang dikirim dalam request
        $productIds = collect($request->products)->pluck('id')->toArray();
        // Ambil data produk dari database berdasarkan ID
        $products = Product::whereIn('id', $productIds)->get();

        // Hitung total harga
        $totalPrice = 0;
        $totalBarang = 0;

        foreach ($products as $product) {
            $quantity = collect($request->products)->firstWhere('id', $product->id)['quantity'];
            $totalPrice += $product->price * $quantity;
            $totalBarang += $quantity;
        }

        // Bersihkan format "Rp" dari customer_pay
        $customerPay = preg_replace('/[^0-9]/', '', $request->input('total_bayar'));

        // Hitung kembalian (customer_return)
        $customerReturn = $customerPay - $totalPrice;
        $order = new Order();

        if ($request->input('member_status') == 'member') {
            // Cek apakah member sudah ada berdasarkan no_telp
            $member = Member::where('no_telp', $request->input('no_telp'))->first();

            if (!$member) {
                $member = Member::create([
                    'no_telp' => $request->input('no_telp'),
                ]);
            }

            // Simpan order ke session
            $orderData = [
                'products' => $products->map(function ($product) use ($request) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => collect($request->products)->firstWhere('id', $product->id)['quantity'],
                    ];
                })->toArray(),
                'members_id' => $member->id,
                'users_id' => Auth::user()->id,
                'tanggal_penjualan' => now(),
                'total_barang' => $totalBarang,
                'total_harga' => $totalPrice,
                'customer_pay' => $customerPay,
                'customer_return' => $customerReturn,
                'no_telp' => $member->no_telp,
                'point' => $member->point ?? 0,
            ];
            // Pastikan name_customer masuk ke array meskipun kosong
            if (!empty($member->name_member)) {
                $orderData['name_customer'] = $member->name_member;
            }

            session(['checkout_member' => $orderData]);

            return redirect()->route('orders.show-checkout-member');
        }

        if ($request->input('member_status') == 'bukan-member') {
            $order->name_customer = 'Bukan Member';
            $order->products_id = json_encode($products->map(function ($product) use ($request) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => collect($request->products)->firstWhere('id', $product->id)['quantity'],
                ];
            }));
            $order->users_id = Auth::user()->id;
            $order->tanggal_penjualan = date('Y-m-d H:i:s');
            $order->total_barang = $totalBarang;
            $order->total_harga = $totalPrice;
            $order->customer_pay = $customerPay;
            $order->customer_return = $customerReturn;
            $order->save();

            foreach ($products as $product) {
                $quantity = collect($request->products)->firstWhere('id', $product->id)['quantity'];
                $product->stock -= $quantity;
                $product->save();
            }

            return redirect()->route('orders.detail-order-member', $order->id);
        }
    }

    public function showCheckoutMember()
    {
        // Ambil data dari session
        $orderData = session('checkout_member');


        if (!$orderData) {
            return redirect()->route('orders.index')->with('error', 'Tidak ada data checkout.');
        }

        $products = Product::whereIn('id', collect($orderData['products'])->pluck('id'))->get();

        return view('orders.checkout-member', [
            'products' => $products,
            'checkoutProducts' => collect($orderData['products'])->pluck('quantity', 'id')->toArray(),
            'totalPrice' => $orderData['total_harga'],
            'orderData' => $orderData
        ]);
    }

    public function storeOrderMember(Request $request)
    {
        // Ambil array ID dari produk yang dikirim dalam request
        $productIds = collect($request->products)->pluck('id')->toArray();
        // Ambil data produk dari database berdasarkan ID
        $products = Product::whereIn('id', $productIds)->get();

        // Hitung total harga
        $totalPrice = 0;
        $totalBarang = 0;

        foreach ($products as $product) {
            $quantity = collect($request->products)->firstWhere('id', $product->id)['quantity'];
            $totalPrice += $product->price * $quantity;
            $totalBarang += $quantity;
        }

        // Bersihkan format "Rp" dari customer_pay
        $customerPay = preg_replace('/[^0-9]/', '', $request->input('customer_pay'));

        // Hitung kembalian (customer_return)
        $customerReturn = $customerPay - $totalPrice;

        $order = new Order();

        $order->products_id = json_encode($products->map(function ($product) use ($request) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => collect($request->products)->firstWhere('id', $product->id)['quantity'],
            ];
        }));
        $order->users_id = Auth::user()->id;
        $order->tanggal_penjualan = date('Y-m-d H:i:s');
        $order->total_barang = $totalBarang;
        $order->total_harga = $totalPrice;
        $order->customer_pay = $customerPay;
        $order->customer_return = $customerReturn;
        $order->members_id = $request->input('member_id');
        $order->save();

        foreach ($products as $product) {
            $quantity = collect($request->products)->firstWhere('id', $product->id)['quantity'];
            $product->stock -= $quantity;
            $product->save();
        }

        $member = Member::where('id', $order->members_id)->first();

        // Pastikan data member tersedia
        $memberPointsUsed = 0; // Default point yang digunakan adalah 0
        if ($member && $request->has('use_point')) {
            $memberPointsUsed = min($member->point, $totalPrice); // Gunakan point sebanyak mungkin tapi tidak lebih dari total harga
            $totalPrice -= $memberPointsUsed; // Kurangi total harga dengan point yang digunakan

            // Kurangi point member setelah digunakan
            $member->point -= $memberPointsUsed;
            $member->save();

            // Update total harga order setelah menggunakan point
            $order->total_harga = $totalPrice;
            $order->save();
        } else {
            // Jika tidak menggunakan point, hitung point baru
            $pointsEarned = floor($totalPrice / 50000) * 10000;
            $member->point += $pointsEarned;
        }

        // Simpan perubahan point member
        $member->save();

        return redirect()->route('orders.detail-order-member', $order->id);
    }

    public function showDetailOrderMember($id)
    {
        $order = Order::with('users', 'products', 'members')->findOrFail($id);
        $products = json_decode($order->products_id, true);
        // dd($order, $products);

        return view('orders.detail-print', compact('order', 'products'));
    }


    public function getIdOrder($id)
    {
        $order = Order::with('users', 'products', 'members')->findOrFail($id);
        $products = json_decode($order->products_id, true);

        if ($order['name_customer'] == null) {
            return response()->json([
                'id' => $order->id,
                'name_customer' => $order->name_customer,
                'products' => $products,
                'user_name' => $order->users->name,
                'tanggal_penjualan' => $order->tanggal_penjualan,
                'total_barang' => $order->total_barang,
                'total_harga' => $order->total_harga,
                'customer_pay' => $order->customer_pay,
                'customer_return' => $order->customer_return,
                'name_member' => $order->members->name_member,
                'point' => $order->members->point,
                'no_telp' => $order->members->no_telp,
                'join_date' => $order->members->created_at,
            ]);
        } else {
            return response()->json([
                'id' => $order->id,
                'name_customer' => $order->name_customer,
                'products' => $products,
                'user_name' => $order->users->name,
                'tanggal_penjualan' => $order->tanggal_penjualan,
                'total_barang' => $order->total_barang,
                'total_harga' => $order->total_harga,
                'customer_pay' => $order->customer_pay,
                'customer_return' => $order->customer_return,
            ]);
        }
    }
}
