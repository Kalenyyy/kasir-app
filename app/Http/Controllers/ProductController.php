<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index()
    {
        //code here
        $products = Product::with('categories')->get();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'price' => 'required|string',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg', // Validasi gambar
        ]);


        $cleanedPrice = str_replace(['Rp', '.', ' '], '', $request->price);

        // Simpan file ke storage/app/public/image_product
        $imagePath = $request->file('image')->store('image_product', 'public');

        // Tambahkan produk baru ke database
        Product::create([
            'name' => $request->name,
            'price' => $cleanedPrice, // Simpan harga yang sudah bersih
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);



        return redirect()->route('products.index')->with('success', 'Product berhasil ditambahkan');
    }

    public function GetIdProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'category_id' => $product->categories->id,
            'category_name' => $product->categories->name,
            'image' => $product->image,
            'categories' => $categories // Kirim daftar kategori
        ]);
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->stock = $request->stock;
        $product->save();

        return response()->json(['message' => 'Stock produk berhasil diupdate']);
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|string',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg', // Gambar bisa optional
        ]);

        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Update data produk
        $product->name = $request->name;
        $product->price = $request->price; // Simpan harga bersih tanpa format Rp
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;

        // Jika ada gambar baru yang diunggah, simpan
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image_product', 'public');
            $product->image = $imagePath;
        }

        // Simpan perubahan ke database
        $product->save();

        return response()->json(['message' => 'Produk berhasil diupdate']);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'success' => true, // Tambahkan properti success
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}
