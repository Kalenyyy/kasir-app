@extends('layouts.template')

@section('modal')
@endsection

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <div class="flex justify-between items-center border-b pb-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">08987547926</h2>
                <p class="text-sm text-gray-500">MEMBER SEJAK: 27 February 2025</p>
                <p class="text-sm text-gray-500">MEMBER POIN: 0</p>
            </div>
            <div class="text-right">
                <p class="text-gray-500">Invoice - #{{ $order->id }}</p>
                <p class="font-semibold text-gray-800">05 March 2025</p>
            </div>
        </div>

        <div class="mt-4">
            <table class="w-full border-collapse rounded-lg overflow-hidden shadow-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="py-3 px-4 text-left">Produk</th>
                        <th class="py-3 px-4 text-left">Harga</th>
                        <th class="py-3 px-4 text-left">Quantity</th>
                        <th class="py-3 px-4 text-left">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t bg-white hover:bg-gray-50">
                        <td class="py-3 px-4">Alat Solat</td>
                        <td class="py-3 px-4">Rp. 20.000</td>
                        <td class="py-3 px-4">2</td>
                        <td class="py-3 px-4">Rp. 40.000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-gray-100 p-4 mt-4 rounded-lg shadow-sm">
            @if ($order->members == !null)
                <div class="flex justify-between items-center">
                    <p class="font-semibold text-gray-700">Poin Digunakan</p>
                    <p class="text-gray-900">400</p>
                </div>
            @endif
            <div class="flex justify-between items-center mt-2">
                <p class="font-semibold text-gray-700">Kasir</p>
                <p class="text-gray-900">{{ $order->users->name }}</p>
            </div>
            <div class="flex justify-between items-center mt-2">
                <p class="font-semibold text-gray-700">Kembalian</p>
                <p class="text-gray-900">Rp. 60.400</p>
            </div>
        </div>

        <div class="bg-gray-900 text-white text-xl font-semibold p-4 mt-4 rounded-lg text-right shadow-md">
            <p>TOTAL: Rp. 39.600</p>
        </div>

        <div class="mt-6 flex justify-end gap-4">
            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-md transition duration-200">Unduh</button>
            <button
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-lg shadow-md transition duration-200">Kembali</button>
        </div>
    </div>
@endsection
