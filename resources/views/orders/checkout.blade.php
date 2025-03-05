@extends('layouts.template')

@section('content')
    <form action="{{ route('orders.store') }}" method="post">
        @csrf
        <div class="container mx-auto p-6">
            <div class="bg-white shadow-lg rounded-lg p-6 gap-6 flex justify-between">
                <!-- Bagian Kiri: Produk yang dipilih -->
                <div class="w-1/2">
                    <h2 class="text-xl font-semibold mb-4">Produk yang dipilih</h2>

                    <div class="space-y-3">
                        @foreach ($products as $product)
                            <input type="hidden" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">
                            <input type="hidden" name="products[{{ $product->id }}][quantity]"
                                value="{{ $checkoutProducts[$product->id] }}">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-700 font-medium">{{ $product->name }}</p>
                                    <p class="text-gray-500 text-sm">Rp. {{ number_format($product->price, 0, ',', '.') }} x
                                        {{ $checkoutProducts[$product->id] }}</p>
                                </div>
                                <p class="text-lg font-semibold text-gray-900">Rp.
                                    {{ number_format($product->price * $checkoutProducts[$product->id], 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total -->
                    <div class="mt-4 border-t pt-3">
                        <p class="text-lg font-semibold text-gray-900">Total</p>
                        <p class="text-2xl font-bold text-blue-600">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Bagian Kanan: Member Status dan Form -->
                <div class="w-1/2 pl-6">
                    <div>
                        <label class="text-gray-700 font-medium">Member Status
                            <span class="text-red-500 text-sm">Dapat juga membuat member</span>
                        </label>
                        <select id="member-status" name="member_status"
                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                            <option value="bukan-member">Bukan Member</option>
                            <option value="member">Member</option>
                        </select>
                    </div>

                    <!-- Input Nomor Telepon (Hidden by Default) -->
                    <div id="phone-input" class="mt-4 hidden">
                        <label for="phone" class="text-gray-700 font-medium">Nomor Telepon</label>
                        <input type="text" id="phone" name="no_telp"
                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                            placeholder="Masukkan nomor telepon">
                    </div>

                    <div class="mt-4">
                        <label for="total-bayar" class="text-gray-700 font-medium">Total Bayar</label>
                        <input type="text" id="total-bayar" name="total_bayar"
                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                            placeholder="Total Bayar" oninput="formatCurrency(this); checkPayment();">
                    </div>

                    <button id="order-button" disabled
                        class="mt-4 w-full bg-gray-400 text-white py-2 rounded-lg cursor-not-allowed">Pesan</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        const totalPrice = {{ $totalPrice }}; // Ambil total price dari server

        document.getElementById('member-status').addEventListener('change', function() {
            let phoneInput = document.getElementById('phone-input');
            if (this.value === 'member') {
                phoneInput.classList.remove('hidden');
            } else {
                phoneInput.classList.add('hidden');
            }
        });

        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, '');
            value = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value);
            input.value = value;
        }

        function checkPayment() {
            let totalBayarInput = document.getElementById('total-bayar').value.replace(/\D/g,
                ''); // Hapus karakter non-digit
            let orderButton = document.getElementById('order-button');

            if (parseInt(totalBayarInput) >= totalPrice) {
                orderButton.disabled = false;
                orderButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                orderButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
            } else {
                orderButton.disabled = true;
                orderButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                orderButton.classList.add('bg-gray-400', 'cursor-not-allowed');
            }
        }
    </script>
@endsection
