@extends('layouts.template')

@section('modal')
    {{-- Modal Tambah User --}}
    <div id="add-user-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Create New User
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="add-user-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="post" action="{{ route('users.store') }}">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="Type user name" required>
                        </div>
                        <div class="col-span-2">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="Type user email" required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="Type user password" required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="Role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                            <select id="Role" name="role" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected hidden>Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Kasir">Kasir</option>
                            </select>
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
                        Add new user
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit User --}}
    <div id="edit-user-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Update Data User
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="edit-user-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="form-update" method="post" action="">
                    @csrf
                    @method('PATCH')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name_user"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="Type user name" required>
                        </div>
                        <div class="col-span-2">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">email</label>
                            <input type="email" name="email" id="email_user"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="Type user email" required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">password</label>
                            <input type="password" name="password" id="password_user"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="Type user password" required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                            <select id="role_user" name="role" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected hidden>Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Kasir">Kasir</option>
                            </select>
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
                        Update Data User
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
        <h2 class="text-2xl font-bold text-[#3F4151] mb-4">User Management</h2>

        <div class="flex flex-col sm:flex-row flex-wrap sm:items-center justify-between pb-4">
            <div class="relative flex items-center space-x-2">
                <input type="text" id="table-search"
                    class="block p-2 ps-10 text-sm text-[#3F4151] border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-[#3F4151] focus:border-[#3F4151]"
                    placeholder="Search for users">
            </div>
            <button type="button" data-modal-target="add-user-modal" data-modal-toggle="add-user-modal"
                class="flex items-center gap-2 text-white bg-[#3F4151] hover:bg-gray-700 focus:ring-gray-400 font-medium rounded-lg text-sm px-4 py-2 shadow transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.5 1.5M4 9a8 8 0 0116 0v4a8 8 0 01-16 0V9z"></path>
                </svg>
                Tambah User
            </button>
        </div>

        <table class="w-full text-sm text-left text-[#3F4151] border border-gray-200 rounded-lg overflow-hidden">
            <thead class="text-xs text-white uppercase bg-[#3F4151]">
                <tr>
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3">Username</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            @foreach ($users as $user)
                <tbody>
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-200 transition">
                        <th class="px-6 py-4 font-medium text-[#3F4151]">
                            {{ $user->id }}
                        </th>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ $user->role }}</td>
                        <td class="px-6 py-4">
                            <button class="font-medium text-[#3F4151] hover:underline edit-button"
                                id="{{ $user->id }}" data-modal-target="edit-user-modal"
                                data-modal-toggle="edit-user-modal">Edit </button> |
                            <button class="font-medium text-[#3F4151] hover:underline">Delete</button>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.edit-button');
            const modal = document.getElementById('edit-user-modal');
            const nameInput = document.getElementById('name_user');
            const emailInput = document.getElementById('email_user');
            const roleSelect = document.getElementById('role_user');
            const passwordInput = document.getElementById('password_user');
            const form = document.getElementById('form-update');
            let userId = null;

            buttons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    userId = this.getAttribute('id'); // Simpan userId dari tombol edit

                    $.ajax({
                        url: `http://127.0.0.1:8000/users/edit/${userId}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);

                            nameInput.value = response.name;
                            emailInput.value = response.email;
                            roleSelect.value = response.role;

                            modal.classList.remove('hidden');
                        },
                        error: function(error) {
                            console.log(error.responseText);
                            alert("Error: " + error.responseText);
                        }
                    });
                });
            });

            // Perbaiki cara mengambil userId saat submit form
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                let formData = {
                    _token: document.querySelector('input[name="_token"]').value,
                    _method: 'PATCH',
                    name: nameInput.value,
                    email: emailInput.value,
                    role: roleSelect.value,
                    password: passwordInput.value
                };

                $.ajax({
                    url: `http://127.0.0.1:8000/users/update/${userId}`, // Gunakan userId yang benar
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        alert(response.message);
                        modal.classList.add('hidden');
                        location.reload();
                    },
                    error: function(error) {
                        console.error(error.responseText);
                        alert("Gagal mengupdate data");
                    }
                });
            });

        });
    </script>
@endsection
