@extends('layouts.template')

@section('content')
    <div class="flex justify-center items-center">
        <div class="flex flex-nowrap my-2 w-full">
            <div class="w-1/3 p-2">
                <a href="">
                    <div class="flex items-center flex-row w-full bg-[#FF9100] rounded-md p-3">
                        <div
                            class="flex text-[#FF9100] items-center bg-white p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                                stroke="currentColor" class="object-scale-down transition duration-500">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                            <div class="text-xs whitespace-nowrap">
                                Total User
                            </div>
                            <div class="">
                                {{ $users_count }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="w-1/3 p-2">
                <a href="">
                    <div class="flex items-center flex-row w-full bg-[#FF9100] rounded-md p-3">
                        <div
                            class="flex text-[#FF9100] items-center bg-white p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                                stroke="currentColor" class="object-scale-down transition duration-500 ">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                            <div class="text-xs whitespace-nowrap">
                                Stock Product
                            </div>
                            <div class="">
                                {{ number_format($products_count, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="w-1/3 p-2">
                <a href="">
                    <div class="flex items-center flex-row w-full bg-[#FF9100] rounded-md p-3">
                        <div
                            class="flex text-[#FF9100] items-center bg-white p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                                stroke="currentColor" class="object-scale-down transition duration-500">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                            <div class="text-xs whitespace-nowrap">
                                Laporan Terjual
                            </div>
                            <div class="">
                                0
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <h1 class="text-center font-bold text-xl mt-5">Laporan Diagram</h1>
    <div class="px-10 flex gap-5">
        <div class="w-[70%] mt-5 border-2 rounded-xl h-[500px] p-4">
            <div class="flex justify-between items-center mb-3">
                <h2 class="font-semibold text-lg">Total Penjualan Perbulan</h2>
                <div class="relative">
                    <button id="dropdownButton" data-dropdown-toggle="yearDropdown"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center">
                        Pilih Tahun
                        <svg class="w-4 h-4 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8l5 5 5-5"></path>
                        </svg>
                    </button>
                    <div id="yearDropdown"
                        class="hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-36">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownButton">
                            <li><button data-year="2023"
                                    class="block px-4 py-2 w-full text-left hover:bg-gray-100">2023</button></li>
                            <li><button data-year="2024"
                                    class="block px-4 py-2 w-full text-left hover:bg-gray-100">2024</button></li>
                            <li><button data-year="2025"
                                    class="block px-4 py-2 w-full text-left hover:bg-gray-100">2025</button></li>
                        </ul>
                    </div>
                </div>
            </div>
            <canvas id="myChart"></canvas>
        </div>
        <div class="w-[30%] mt-5 border-2 rounded-xl h-[500px] p-4 flex flex-col items-center">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Penjualan Hari Ini</h3>
            <canvas id="PieChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script>
        const ctx2 = document.getElementById('PieChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Produk Makanan', 'Produk Minuman', 'Produk Barang'],
                datasets: [{
                    data: [40, 35, 25], // Persentase atau jumlah produk dalam masing-masing kategori
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)', // Warna untuk makanan
                        'rgba(255, 159, 64, 0.5)', // Warna untuk minuman
                        'rgba(153, 102, 255, 0.5)' // Warna untuk barang
                    ],
                    borderColor: [
                        'rgb(75, 192, 192)',
                        'rgb(255, 159, 64)',
                        'rgb(153, 102, 255)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        // Dummy data untuk Bar Chart
        const ctx = document.getElementById('myChart').getContext('2d');
        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        const salesData = {
            2023: [15, 25, 35, 45, 55, 65, 75, 85, 95, 105, 115, 125],
            2024: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
            2025: [5, 15, 25, 35, 45, 55, 65, 75, 85, 95, 105, 115]
        };

        function generateColors(length) {
            const colors = [
                'rgba(75, 192, 192, 0.5)', 'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)', 'rgba(231, 76, 60, 0.5)',
                'rgba(155, 89, 182, 0.5)', 'rgba(46, 204, 113, 0.5)',
                'rgba(241, 196, 15, 0.5)', 'rgba(39, 174, 96, 0.5)',
                'rgba(142, 68, 173, 0.5)', 'rgba(44, 62, 80, 0.5)',
                'rgba(211, 84, 0, 0.5)', 'rgba(192, 57, 43, 0.5)',
            ];
            return colors.slice(0, length);
        }

        let myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Penjualan Perbulan',
                    data: salesData[2024], // Default tahun 2024
                    backgroundColor: generateColors(labels.length),
                    borderColor: generateColors(labels.length).map(color => color.replace('0.5', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Event listener untuk dropdown pilihan tahun
        document.querySelectorAll('#yearDropdown button').forEach(button => {
            button.addEventListener('click', function() {
                const selectedYear = this.getAttribute('data-year');
                myBarChart.data.datasets[0].data = salesData[selectedYear];
                myBarChart.update();
                document.getElementById('dropdownButton').innerHTML = `Tahun ${selectedYear}
                <svg class="w-4 h-4 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 8l5 5 5-5"></path>
                </svg>`;
            });
        });
    </script>
@endsection
