@extends('layouts.template')

@section('modal')
    {{-- Modal Tambah Product --}}
    <div id="add-product-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm border border-gray-300">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Create New Product
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="add-product-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('products.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Product</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Type product name" required>
                        </div>
                        <div class="col-span-2">
                            <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stok</label>
                            <input type="number" name="stock" id="stock"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Type stock" required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                            <input type="text" name="price" id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="2999" required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                            <select id="category" name="category_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected hidden disabled>Jenis Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload
                                Gambar</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                id="file_input" type="file" name="image" required>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add new product
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Update Stock Product --}}
    <div id="update-stock-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Update Stock Product
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="update-stock-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form class="p-4 md:p-5" id="form-update-stock">
                    @csrf
                    @method('PATCH')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name_product" readonly
                                class="bg-gray-200 border border-gray-400 text-gray-800 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 cursor-not-allowed"
                                placeholder="Type product name">
                        </div>
                    </div>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                            <input type="text" name="stock" id="stock_product"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Edit product stock" required>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Update Stock
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Update Product --}}
    <div id="update-product-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Update Product
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="update-product-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="form-update-product">
                    @csrf
                    @method('PATCH')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name_product" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name_product_update"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Type product name" required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="price_product" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                            <input type="text" name="price" id="price_product_update"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="$2999" required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="stock_product" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                            <input type="number" name="stock_product" id="stock_product_update"
                                class="bg-gray-200 border border-gray-400 text-gray-800 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 cursor-not-allowed"
                                placeholder="$2999" required readonly>
                        </div>
                        <div class="col-span-2">
                            <label for="category_product"
                                class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                            <select id="category_product_update" name="category_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option selected>Select category</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">
                                Upload Gambar
                            </label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                type="file" name="image" id="image_product_update">

                            <!-- Tambahkan preview gambar -->
                            <img id="image_preview_update" src="" alt="Preview Image"
                                class="hidden mt-3 rounded-lg w-40 h-40 object-cover">
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Update data product
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Success alert!</span> {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Danger alert!</span> {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="relative overflow-x-auto sm:rounded-lg p-6 bg-white shadow-md">
        <h2 class="text-2xl font-bold text-[#3F4151] mb-4">Product Management</h2>

        @if (Auth::user()->role == 'Admin')
            <div class="flex flex-col sm:flex-row flex-wrap sm:items-center justify-between pb-4">
                <div class="relative flex items-center space-x-2">
                    <input type="text" id="table-search"
                        class="block p-2 ps-10 text-sm text-[#3F4151] border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-[#3F4151] focus:border-[#3F4151]"
                        placeholder="Search for products">
                </div>
                <button type="button" data-modal-target="add-product-modal" data-modal-toggle="add-product-modal"
                    class="flex items-center gap-2 text-white bg-[#3F4151] hover:bg-gray-700 focus:ring-gray-400 font-medium rounded-lg text-sm px-4 py-2 shadow transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.5 1.5M4 9a8 8 0 0116 0v4a8 8 0 01-16 0V9z"></path>
                    </svg>
                    Tambah Product
                </button>
            </div>
        @endif

        <table class="w-full text-sm text-left text-[#3F4151] border border-gray-200 rounded-lg overflow-hidden">
            <thead class="text-xs text-white uppercase bg-[#3F4151]">
                <tr>
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3"></th>
                    <th scope="col" class="px-6 py-3">Nama Product</th>
                    <th scope="col" class="px-6 py-3">Harga</th>
                    <th scope="col" class="px-6 py-3">Stok</th>
                    <th scope="col" class="px-6 py-3">Jenis Product</th>
                    @if (Auth::user()->role == 'Admin')
                        <th scope="col" class="px-6 py-3">Action</th>
                    @endif
                </tr>
            </thead>
            @foreach ($products as $product)
                <tbody>
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-200 transition">
                        <th class="px-6 py-4 font-medium text-[#3F4151]">
                            {{ $product->id }}
                        </th>
                        <td class="px-6 py-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-32 h-32 object-cover rounded-md">
                        </td>
                        <td class="px-6 py-4">{{ $product->name }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ number_format($product->stock, 0, ',', '.') }}</td>

                        <td class="px-6 py-4">{{ $product->categories->name }}</td>
                        @if (Auth::user()->role == 'Admin')
                            <td class="px-6 py-4">
                                <button class="font-medium text-[#3F4151] hover:underline edit-product-button"
                                    data-modal-target="update-product-modal" data-modal-toggle="update-product-modal"
                                    id="{{ $product->id }}">Edit
                                </button> |
                                <button class="font-medium text-[#3F4151] hover:underline edit-product-stock-button"
                                    data-modal-target="update-stock-modal" data-modal-toggle="update-stock-modal"
                                    id="{{ $product->id }}">Update Stock
                                </button> |
                                <button class="font-medium text-[#3F4151] hover:underline delete-product-button"
                                    id="{{ $product->id }}">Delete
                                </button>
                            </td>
                        @endif
                    </tr>
                </tbody>
            @endforeach

        </table>
    </div>

    {{-- script Rupiah tambah data --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const priceInput = document.getElementById("price");

            priceInput.addEventListener("input", function(e) {
                let value = priceInput.value.replace(/\D/g, ""); // Hanya ambil angka
                value = new Intl.NumberFormat("id-ID").format(value); // Format angka dengan titik
                priceInput.value = value ? `Rp ${value}` : ""; // Tambahkan Rp di awal
            });

            priceInput.addEventListener("focus", function() {
                if (priceInput.value === "") {
                    priceInput.value = "Rp ";
                }
            });

            priceInput.addEventListener("blur", function() {
                if (priceInput.value === "Rp ") {
                    priceInput.value = "";
                }
            });
        });
    </script>

    {{-- Script Update Stock Modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editProductStockButtons = document.querySelectorAll('.edit-product-stock-button');
            const modal = document.getElementById('update-stock-modal');
            const nameInput = document.getElementById('name_product');
            const stockInput = document.getElementById('stock_product');
            const formUpdateStock = document.getElementById('form-update-stock');
            let productId = null;

            editProductStockButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    productId = this.getAttribute('id');

                    $.ajax({
                        url: `http://127.0.0.1:8000/products/edit/${productId}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);

                            nameInput.value = response.name;
                            stockInput.value = response.stock;

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

            formUpdateStock.addEventListener('submit', function(event) {
                event.preventDefault();

                let formData = {
                    _token: document.querySelector('input[name="_token"]').value,
                    _method: 'PATCH',
                    stock: stockInput.value
                };

                $.ajax({
                    url: `http://127.0.0.1:8000/products/update-stock/${productId}`,
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                        }).then(() => {
                            modal.classList.add('hidden');
                            location.reload();
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal mengupdate data',
                        });
                    }
                });
            });
        });
    </script>

    {{-- Script Update Product Modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editProductButtons = document.querySelectorAll('.edit-product-button');
            const modal = document.getElementById('update-product-modal');
            const nameInput = document.getElementById('name_product_update');
            const stockInput = document.getElementById('stock_product_update');
            const priceInput = document.getElementById('price_product_update');
            const categoryInput = document.getElementById('category_product_update');
            const imageInput = document.getElementById('image_product_update');
            const imagePreview = document.getElementById('image_preview_update');
            const formUpdateProduct = document.getElementById('form-update-product');
            let productId = null;

            function formatRupiah(angka) {
                return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            editProductButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    productId = this.getAttribute('id');

                    $.ajax({
                        url: `http://127.0.0.1:8000/products/edit/${productId}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);

                            // Isi input modal dengan data dari response API
                            nameInput.value = response.name;
                            stockInput.value = response.stock;
                            priceInput.value = formatRupiah(response.price);
                            categoryInput.innerHTML =
                                '<option disabled>Select category</option>';

                            // Tambahkan opsi kategori dari API
                            response.categories.forEach(category => {
                                const option = document.createElement('option');
                                option.value = category.id;
                                option.textContent = category.name;

                                // Pilih kategori yang sesuai dengan produk
                                if (category.id === response.category_id) {
                                    option.selected = true;
                                }

                                categoryInput.appendChild(option);
                            });

                            // Tampilkan gambar produk
                            if (response.image) {
                                imagePreview.src =
                                    `http://127.0.0.1:8000/storage/${response.image}`;
                                imagePreview.classList.remove('hidden');
                            } else {
                                imagePreview.classList.add('hidden');
                            }

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

            // Event listener untuk memastikan input harga tetap dalam format rupiah
            priceInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^0-9]/g, ""); // Hanya ambil angka
                if (value) {
                    e.target.value = formatRupiah(value);
                } else {
                    e.target.value = "";
                }
            });

            formUpdateProduct.addEventListener('submit', function(event) {
                event.preventDefault();

                let formData = new FormData(); // Buat objek FormData untuk upload file
                formData.append('_token', document.querySelector('input[name="_token"]').value);
                formData.append('_method', 'PATCH');
                formData.append('name', nameInput.value);
                formData.append('price', priceInput.value.replace(/[^0-9]/g,
                    '')); // Hapus "Rp" sebelum dikirim
                formData.append('category_id', categoryInput.value);
                formData.append('stock', stockInput.value);

                // Jika ada file yang diunggah, tambahkan ke FormData
                if (imageInput.files.length > 0) {
                    formData.append('image', imageInput.files[0]);
                }

                $.ajax({
                    url: `http://127.0.0.1:8000/products/update-product/${productId}`,
                    method: 'POST',
                    data: formData,
                    contentType: false, // Jangan ubah tipe konten
                    processData: false, // Jangan ubah data menjadi string
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                        }).then(() => {
                            modal.classList.add('hidden');
                            location.reload();
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal mengupdate data',
                        });
                    }
                });
            });
        });
    </script>

    {{-- Script Delete Product --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-product-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('id');

                    // Tampilkan SweetAlert konfirmasi sebelum menghapus
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`http://127.0.0.1:8000/products/delete-product/${productId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').content,
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil!',
                                            text: 'Product berhasil dihapus.',
                                        }).then(() => {
                                            location
                                                .reload(); // Reload halaman setelah delete
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal!',
                                            text: 'Gagal menghapus Product!',
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terjadi Kesalahan!',
                                        text: 'Gagal menghapus Product. Silakan coba lagi.',
                                    });
                                    console.error('Error:', error);
                                });
                        }
                    });
                });
            });
        });
    </script>
@endsection
