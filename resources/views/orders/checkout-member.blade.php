@extends('layouts.template')

@section('modal')
@endsection

@section('content')
    <form action="{{ route('orders.store-order-member') }}" method="post">
        @csrf
        <input type="hidden" name="member_id" value="{{ $orderData['members_id'] }}">
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
                    @if (!empty($orderData['name_customer']))
                        <div class="mt-4">
                            <label for="name_member" class="text-gray-700 font-medium">Nama Member</label>
                            <input type="text" id="name_member" name="name_member" value="{{ $orderData['name_customer'] }}"
                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                                placeholder="Nama Member">
                        </div>
                    @else
                        <div class="mt-4">
                            <label for="name_member" class="text-gray-700 font-medium">Nama Member</label>
                            <input type="text" id="name_member" name="name_member"
                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                                placeholder="Nama Member">
                        </div>
                    @endif

                    <!-- Input Nomor Telepon (Hidden by Default) -->
                    <div id="phone-input" class="mt-4">
                        <label for="phone" class="text-gray-700 font-medium">Nomor Telepon</label>
                        <input type="text" id="phone" name="no_telp" value="{{ $orderData['no_telp'] }}"
                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed"
                            placeholder="Masukkan nomor telepon">
                    </div>

                    <div class="mt-4">
                        <label for="customer-pay" class="text-gray-700 font-medium">Jumlah Uang</label>
                        <input type="text" id="customer-pay" name="customer_pay"
                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed"
                            placeholder="Masukkan jumlah uang" readonly
                            value="Rp. {{ number_format($orderData['customer_pay'], 0, ',', '.') }}">
                    </div>

                    <div class="flex items-center mt-4 space-x-3">
                        <!-- Custom Checkbox -->
                        <input id="helper-checkbox" type="checkbox" name="use_point"
                            class="w-5 h-5 text-blue-600 bg-gray-200 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 cursor-pointer"
                            @if ($orderData['point'] == 0 || $orderData['point'] == null) disabled @endif>

                        <!-- Label & Deskripsi -->
                        <div class="text-sm">
                            <label for="helper-checkbox" class="font-medium text-gray-900">
                                Point: {{ number_format($orderData['point'], 0, ',', '.') }} 
                            </label>
                            <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500">
                                @if ($orderData['point'] == 0 || $orderData['point'] == null)
                                    Pembelian pertama atau point 0 tidak bisa menggunakan point.
                                @else
                                    Kamu bisa menggunakan point untuk diskon.
                                @endif
                            </p>
                        </div>
                    </div>


                    <button id="order-button" type="submit"
                        class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">Pesan</button>
                </div>
            </div>
        </div>
    </form>
@endsection
