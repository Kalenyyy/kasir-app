<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir App</title>
    <script src="https://kit.fontawesome.com/1464b01d02.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="body bg-white">
    @yield('modal')
    <div class="fixed w-full z-30 flex bg-white p-2 items-center justify-center h-16 px-10">
        <div class="flex-shrink-0">
            <img src="{{ asset('image/logo.png') }}" alt="" class="h-8 ml-20">
        </div>
        <div class="ml-3 text-dark font-bold transform ease-in-out duration-500 flex items-center">
            Cartelytics
        </div>
        <!-- SPACER -->
        <div class="grow h-full flex items-center justify-center"></div>
        <div class="flex-none h-full text-center flex items-center justify-center">

            <div class="flex space-x-3 items-center px-3">
                <!-- Container untuk gambar avatar dan dropdown -->
                <div class="flex items-center">
                    <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                        class="flex items-center text-sm pe-1 font-medium rounded-full hover:text-[#3F4151] md:me-0 focus:ring-4 focus:ring-[#3F4151]  text-black"
                        type="button">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 me-2 rounded-full" src="" alt="user photo">
                        {{ Auth::user()->name }}
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownAvatarName"
                        class="z-10 hidden bg-white divide-y  rounded-lg shadow w-44 divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 "
                            aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2  hover:bg-[#3F4151] hover:text-white">Settings</a>
                            </li>
                        </ul>
                        <div class="py-2">
                            <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-gray-700  hover:bg-[#3F4151]  hover:text-white">Sign
                                out</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <aside
        class="w-60 -translate-x-48 fixed transition transform ease-in-out duration-1000 z-50 flex h-screen bg-[#3F4151] ">
        <!-- open sidebar button -->
        <div
            class="max-toolbar translate-x-24 scale-x-0 w-full -right-6 transition transform ease-in duration-300 flex items-center justify-between border-4  bg-[#3F4151]  absolute top-2 rounded-full h-12">

            <div class="flex pl-4 items-center space-x-2 ">
                <div>
                </div>
                <div class ="text-white hover:bg-[#3F4151] ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={3}
                        stroke="currentColor" class="w-4 h-4">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </div>
            </div>
            <div
                class ="flex items-center space-x-3 group   via-white-500 to-white-500  pl-10 pr-2 py-1 rounded-full text-white  ">
                <div class="transform ease-in-out duration-300 mr-12">
                    Cartelytics
                </div>
            </div>
        </div>
        <div onclick="openNav()"
            class="-right-6 transition transform ease-in-out duration-500 flex border-4  border-[#ffffff] bg-[#3F4151] hover:bg-[#3F4151] hover:bg-white-500 absolute top-2 p-3 rounded-full text-white hover:rotate-45">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={3}
                stroke="currentColor" class="w-4 h-4">
                <path strokeLinecap="round" strokeLinejoin="round"
                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
        </div>
        <!-- MAX SIDEBAR-->
        <div class="max hidden text-white mt-20 flex-col space-y-2 w-full h-[calc(100vh)]">
            <a href="{{ route('dashboard') }}">
                <div
                    class="hover:ml-4 w-full text-white  bg-[#3F4151] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center gap-x-3">
                    <i class="fa-solid fa-house-chimney" style="color: #ffffff;"></i>
                    <span>Home</span>
                </div>
            </a>
            @if (Auth::user()->role == 'Admin')
                <a href="{{ route('users.index') }}">
                    <div
                        class="hover:ml-4 w-full text-white  bg-[#3F4151] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center gap-x-3">
                        <i class="fa-solid fa-users" style="color: #ffffff;"></i>
                        <span>Stock Products</span>
                    </div>
                </a>
                <a href="{{ route('users.index') }}">
                    <div
                        class="hover:ml-4 w-full text-white  bg-[#3F4151] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center gap-x-3">
                        <i class="fa-solid fa-users" style="color: #ffffff;"></i>
                        <span>Data Penjualan</span>
                    </div>
                </a>
                <a href="{{ route('users.index') }}">
                    <div
                        class="hover:ml-4 w-full text-white  bg-[#3F4151] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center gap-x-3">
                        <i class="fa-solid fa-users" style="color: #ffffff;"></i>
                        <span>User</span>
                    </div>
                </a>
            @endif
        </div>

        <!-- MINI SIDEBAR-->
        <div class="mini mt-20 flex flex-col space-y-2 w-full h-[calc(100vh)]">
            <div
                class="hover:ml-4 justify-end pr-5 text-white hover:text-white-500 hover:text-blue-500 w-full bg-[#3F4151] p-3 rounded-full transform ease-in-out duration-300 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                    stroke="currentColor" class="w-4 h-4">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </div>
            <div
                class="hover:ml-4 justify-end pr-5 text-white hover:text-white-500 hover:text-blue-500 w-full bg-[#3F4151] p-3 rounded-full transform ease-in-out duration-300 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                </svg>
            </div>
            <div
                class="hover:ml-4 justify-end pr-5 text-white hover:text-white-500 hover:text-blue-500 w-full bg-[#3F4151] p-3 rounded-full transform ease-in-out duration-300 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                </svg>
            </div>
        </div>
    </aside>
    <!-- CONTENT -->
    <div class ="content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4">
        <nav class="flex px-5 py-3 text-white  rounded-lg bg-[#3F4151] " aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="" class="inline-flex items-center text-sm font-medium text-white ">
                        <svg class = "w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Home
                    </a>
                </li>

                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fillRule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clipRule="evenodd"></path>
                        </svg>
                        <a href="#"
                            class="ml-1 text-sm font-medium text-white hover:text-white-500 md:ml-2">Templates</a>
                    </div>
                </li>

                @yield('top_content')
            </ol>
        </nav>

        <div class ="flex flex-wrap my-5">
            <div class ="w-full p-2">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        const sidebar = document.querySelector("aside");
        const maxSidebar = document.querySelector(".max")
        const miniSidebar = document.querySelector(".mini")
        const roundout = document.querySelector(".roundout")
        const maxToolbar = document.querySelector(".max-toolbar")
        const logo = document.querySelector('.logo')
        const content = document.querySelector('.content')
        const moon = document.querySelector(".moon")
        const sun = document.querySelector(".sun")

        function setDark(val) {
            if (val === "dark") {
                document.documentElement.classList.add('dark')
                moon.classList.add("hidden")
                sun.classList.remove("hidden")
            } else {
                document.documentElement.classList.remove('dark')
                sun.classList.add("hidden")
                moon.classList.remove("hidden")
            }
        }

        function openNav() {
            if (sidebar.classList.contains('-translate-x-48')) {
                // max sidebar 
                sidebar.classList.remove("-translate-x-48")
                sidebar.classList.add("translate-x-none")
                maxSidebar.classList.remove("hidden")
                maxSidebar.classList.add("flex")
                miniSidebar.classList.remove("flex")
                miniSidebar.classList.add("hidden")
                maxToolbar.classList.add("translate-x-0")
                maxToolbar.classList.remove("translate-x-24", "scale-x-0")
                logo.classList.remove("ml-12")
                content.classList.remove("ml-12")
                content.classList.add("ml-12", "md:ml-60")
            } else {
                // mini sidebar
                sidebar.classList.add("-translate-x-48")
                sidebar.classList.remove("translate-x-none")
                maxSidebar.classList.add("hidden")
                maxSidebar.classList.remove("flex")
                miniSidebar.classList.add("flex")
                miniSidebar.classList.remove("hidden")
                maxToolbar.classList.add("translate-x-24", "scale-x-0")
                maxToolbar.classList.remove("translate-x-0")
                logo.classList.add('ml-12')
                content.classList.remove("ml-12", "md:ml-60")
                content.classList.add("ml-12")

            }

        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</body>

</html>
