@extends('layouts.template')

@section('modal')
    <!-- Extra Large Modal -->
    <div id="extralarge-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-7xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-xl font-medium text-gray-900">
                        Extra Large modal
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="extralarge-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form id="checkout-form" action="{{ route('orders.process') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($products as $product)
                                <div class="w-full bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                                    <img class="p-4 rounded-t-lg" src="{{ asset('storage/' . $product->image) }}"
                                        alt="product image" />

                                    <h5 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h5>

                                    <span class="text-sm text-gray-500">Stock: {{ $product->stock }}</span>

                                    <div class="flex items-center justify-between mt-4">
                                        <button type="button" onclick="decrement('{{ $product->id }}')"
                                            class="px-3 py-1 bg-gray-200 rounded-lg">-</button>
                                        <span id="quantity-{{ $product->id }}" class="mx-3 text-lg font-semibold">0</span>
                                        <button type="button" onclick="increment('{{ $product->id }}')"
                                            class="px-3 py-1 bg-blue-700 text-white rounded-lg">+</button>

                                        <input type="hidden" name="product_ids[]" value="{{ $product->id }}">
                                    </div>

                                    <!-- Input hidden untuk menyimpan jumlah -->
                                    <input type="hidden" id="input-quantity-{{ $product->id }}"
                                        name="quantities[{{ $product->id }}]" value="0">
                                </div>
                            @endforeach
                        </div>

                        <!-- Modal footer -->
                        <div
                            class="flex items-center justify-center p-4 md:p-5 space-x-3 border-t border-gray-200 rounded-b">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                Checkout
                            </button>
                            <button type="button" data-modal-hide="extralarge-modal"
                                class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Large Modal -->
    <div id="sales-detail-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-3xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">
                        Detail Penjualan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="sales-detail-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4 text-gray-700">
                    <div class="flex justify-between text-sm">
                        <div>
                            <p><strong>Member Status:</strong> <span id="member-status"></span></p>
                            <p><strong>No. HP:</strong> <span id="no-hp"></span></p>
                            <p><strong>Poin Member:</strong> <span id="poin-member"></span></p>
                        </div>
                        <div class="text-right">
                            <p><strong>Bergabung Sejak:</strong> <span id="joined-at"></span></p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 my-2"></div>
                    <table class="w-full text-sm text-gray-700">
                        <thead>
                            <tr class="text-left font-medium border-b border-gray-200">
                                <th class="py-2">Nama Produk</th>
                                <th class="py-2 text-center">Qty</th>
                                <th class="py-2 text-center">Harga</th>
                                <th class="py-2 text-right">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody id="product-list">

                        </tbody>
                    </table>
                    <div class="border-t border-gray-200 my-2"></div>
                    <div class="flex justify-between font-semibold text-gray-900">
                        <span>Total</span>
                        <span id="total-harga"></span>
                    </div>
                    <div class="text-sm text-gray-500 mt-2">
                        <p>Dibuat pada: <span id="datetime"></span></p>
                        <p>Oleh: <span id="username"></span></p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="p-4 md:p-5 border-t border-gray-200 rounded-b flex justify-end">
                    <button data-modal-hide="sales-detail-modal" type="button"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-gray-100 rounded-lg border border-gray-300 hover:bg-gray-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="relative overflow-x-auto sm:rounded-lg p-6 bg-white shadow-md">
        <h2 class="text-2xl font-bold text-[#3F4151] mb-4">Penjualan Management</h2>

        <div class="flex flex-col sm:flex-row flex-wrap sm:items-center justify-between pb-4">
            <div class="relative flex items-center space-x-2">
                <input type="text" id="table-search"
                    class="block p-2 ps-10 text-sm text-[#3F4151] border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-[#3F4151] focus:border-[#3F4151]"
                    placeholder="Search for users">
            </div>
            <button type="button" data-modal-target="extralarge-modal" data-modal-toggle="extralarge-modal"
                class="flex items-center gap-2 text-white bg-[#3F4151] hover:bg-gray-700 focus:ring-gray-400 font-medium rounded-lg text-sm px-4 py-2 shadow transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.5 1.5M4 9a8 8 0 0116 0v4a8 8 0 01-16 0V9z"></path>
                </svg>
                Tambah Penjualan
            </button>
        </div>

        <table class="w-full text-sm text-left text-[#3F4151] border border-gray-200 rounded-lg overflow-hidden">
            <thead class="text-xs text-white uppercase bg-[#3F4151]">
                <tr>
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3">Nama Pelanggan</th>
                    <th scope="col" class="px-6 py-3">Tanggal Penjualan</th>
                    <th scope="col" class="px-6 py-3">Total Harga</th>
                    <th scope="col" class="px-6 py-3">Dibuat Oleh</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $order)
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-200 transition">
                        <th class="px-6 py-4 font-medium text-[#3F4151]">
                            #
                        </th>
                        @if ($order->members_id)
                            <td class="px-6 py-4">{{ $order->members->name_member }}</td>
                        @else
                            <td class="px-6 py-4">{{ $order->name_customer }}</td>
                        @endif
                        <td class="px-6 py-4">{{ $order->tanggal_penjualan }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $order->users->name }}</td>
                        <td class="px-6 py-4">
                            <button data-modal-target="sales-detail-modal" data-modal-toggle="sales-detail-modal"
                                class="sales-detail block w-full md:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button" id="{{ $order->id }}">
                                Lihat Detail
                            </button>
                            {{-- <button class="font-medium text-[#3F4151] hover:underline">Unduh Bukti</button> --}}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <script>
        function increment(id) {
            let quantityElement = document.getElementById(`quantity-${id}`);
            let inputElement = document.getElementById(`input-quantity-${id}`);
            let quantity = parseInt(quantityElement.innerText);

            quantityElement.innerText = quantity + 1;
            inputElement.value = quantity + 1;
        }

        function decrement(id) {
            let quantityElement = document.getElementById(`quantity-${id}`);
            let inputElement = document.getElementById(`input-quantity-${id}`);
            let quantity = parseInt(quantityElement.innerText);

            if (quantity > 0) {
                quantityElement.innerText = quantity - 1;
                inputElement.value = quantity - 1;
            }
        }
    </script>

    {{-- Script Lihat Detail Penjualan --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editProductStockButtons = document.querySelectorAll('.sales-detail');
            const modal = document.getElementById('sales-detail-modal');
            const memberStatus = document.getElementById('member-status');
            const noHp = document.getElementById('no-hp');
            const poinMember = document.getElementById('poin-member');
            const joinedAt = document.getElementById('joined-at');
            const productTableBody = document.getElementById('product-list');
            const totalHarga = document.getElementById('total-harga');
            const tanggalPenjualan = document.getElementById('datetime');
            const username = document.getElementById('username');
            // const formUpdateStock = document.getElementById('form-update-stock');
            let orderId = null;

            editProductStockButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    orderId = this.getAttribute('id');

                    $.ajax({
                        url: `http://127.0.0.1:8000/orders/check-order/${orderId}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);

                            memberStatus.innerText = response.name_customer || response
                                .name_member;
                            noHp.innerText = response.no_telp || '-';
                            poinMember.innerText = response.point ? response.point.toLocaleString('id-ID') : '0';
                            // Format tanggal join agar hanya menampilkan tanggal, bulan, dan tahun
                            joinedAt.innerText = response.join_date ?
                                new Date(response.join_date).toLocaleDateString(
                                'id-ID', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                }) :
                                '-';

                            // Kosongkan tabel sebelum diisi ulang
                            productTableBody.innerHTML = '';

                            // Looping data produk untuk menampilkan dalam tabel
                            response.products.forEach(product => {
                                const row = `
                                            <tr>
                                                <td class="py-2">${product.name}</td>
                                                <td class="py-2 text-center">${product.quantity}</td>
                                                <td class="py-2 text-center">Rp. ${product.price.toLocaleString('id-ID')}</td>
                                                <td class="py-2 text-right">Rp. ${(product.price * product.quantity).toLocaleString('id-ID')}</td>
                                            </tr>
                                        `;
                                productTableBody.innerHTML += row;
                            });

                            // Tampilkan total harga
                            totalHarga.innerText =
                                `Rp. ${response.total_harga.toLocaleString('id-ID')}`;

                            // Format tanggal penjualan tanpa jam
                            tanggalPenjualan.innerText = response.tanggal_penjualan ?
                                new Date(response.tanggal_penjualan).toLocaleDateString(
                                    'id-ID', {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    }) :
                                '-';
                            username.innerText = response.user_name;

                            modal.classList.remove('hidden');
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat mengambil data!',
                            });
                        }
                    });
                });
            });

            // formUpdateStock.addEventListener('submit', function(event) {
            //     event.preventDefault();

            //     let formData = {
            //         _token: document.querySelector('input[name="_token"]').value,
            //         _method: 'PATCH',
            //         stock: stockInput.value
            //     };

            //     $.ajax({
            //         url: `http://127.0.0.1:8000/products/update-stock/${productId}`,
            //         method: 'POST',
            //         data: formData,
            //         success: function(response) {
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: 'Berhasil!',
            //                 text: response.message,
            //             }).then(() => {
            //                 modal.classList.add('hidden');
            //                 location.reload();
            //             });
            //         },
            //         error: function(error) {
            //             Swal.fire({
            //                 icon: 'error',
            //                 title: 'Gagal!',
            //                 text: 'Gagal mengupdate data',
            //             });
            //         }
            //     });
            // });
        });
    </script>
@endsection
