<template>
    <Head>
        <title>Dashboard - SekolahPay</title>
    </Head>

    <div class="">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-2">
            <!-- <h1 class="text-xl font-semibold text-gray-900">Dashboard</h1> -->
            
            <!-- Statistik Utama -->
            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Widget Transaksi -->
                <div class="bg-white shadow rounded-lg p-3">
                    <div class="flex items-center">
                        <div class="bg-indigo-500 rounded-md p-2">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="text-sm font-medium text-gray-500">Total Pendapatan</div>
                            <div class="text-lg font-semibold text-gray-900">Rp {{ stats.totalTransaksi }}</div>
                        </div>
                    </div>
                </div>

                <!-- Widget Pengguna -->
                <div class="bg-white shadow rounded-lg p-3">
                    <div class="flex items-center">
                        <div class="bg-green-500 rounded-md p-2">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="text-sm font-medium text-gray-500">Total Siswa</div>
                            <div class="flex items-baseline">
                                <div class="text-lg font-semibold text-gray-900">{{ stats.totalSiswa }}</div>
                                <!-- <div class="ml-2 text-xs font-medium text-green-600">+12.5%</div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Widget Sekolah -->
                <div class="bg-white shadow rounded-lg p-3">
                    <div class="flex items-center">
                        <div class="bg-yellow-500 rounded-md p-2">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="text-sm font-medium text-gray-500">Total Kelas</div>
                            <div class="flex items-baseline">
                                <div class="text-lg font-semibold text-gray-900">{{ stats.totalKelas }}</div>
                                <!-- <div class="ml-2 text-xs font-medium text-green-600">+4.75%</div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Widget Pendapatan -->
                <div class="bg-white shadow rounded-lg p-3">
                    <div class="flex items-center">
                        <div class="bg-red-500 rounded-md p-2">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="text-sm font-medium text-gray-500">Pendapatan (Bulan Ini)</div>
                            <div class="flex items-baseline">
                                <div class="text-lg font-semibold text-gray-900">Rp 3.240.000</div>
                                <!-- <div class="ml-2 text-xs font-medium text-green-600">+5.4%</div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Transaksi -->
            <div class="mt-8">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-5 py-4 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Grafik Transaksi (30 hari terakhir)</h3>
                    </div>
                    <div class="p-5">
                        <div class="h-64 bg-gray-50 rounded flex items-center justify-center">
                            <!-- Placeholder untuk grafik, dalam implementasi sesungguhnya gunakan chartjs atau pustaka lain -->
                            <p class="text-gray-500">Area Grafik Transaksi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Transaksi Terbaru & Performa Sekolah -->
            <div class="mt-8 grid grid-cols-1 gap-5 lg:grid-cols-2">
                <!-- Transaksi Terbaru -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-5 py-4 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Transaksi Terbaru</h3>
                    </div>
                    <div class="p-5">
                        <div class="flow-root">
                            <ul class="-my-5 divide-y divide-gray-200">
                                <li class="py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                <span class="text-sm font-medium text-gray-500">AS</span>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">Ahmad Santoso</p>
                                            <p class="text-sm text-gray-500 truncate">Pembayaran SPP - SMA Nusantara</p>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Rp 750.000</div>
                                            <div class="text-sm text-gray-500">10 menit lalu</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                <span class="text-sm font-medium text-gray-500">DP</span>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">Dewi Putri</p>
                                            <p class="text-sm text-gray-500 truncate">Uang Kegiatan - SD Harapan</p>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Rp 250.000</div>
                                            <div class="text-sm text-gray-500">25 menit lalu</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                <span class="text-sm font-medium text-gray-500">RW</span>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">Rudi Wijaya</p>
                                            <p class="text-sm text-gray-500 truncate">Pembayaran Seragam - SMP Cendekia</p>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Rp 450.000</div>
                                            <div class="text-sm text-gray-500">1 jam lalu</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                <span class="text-sm font-medium text-gray-500">SH</span>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">Siti Hastuti</p>
                                            <p class="text-sm text-gray-500 truncate">Pembayaran SPP - SMK Teknologi</p>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Rp 500.000</div>
                                            <div class="text-sm text-gray-500">2 jam lalu</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-6">
                            <a href="#" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Lihat Semua Transaksi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Performa Sekolah -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-5 py-4 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Top Sekolah</h3>
                    </div>
                    <div class="p-5">
                        <ul class="divide-y divide-gray-200">
                            <li class="py-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <span class="text-indigo-800 font-medium">SMA</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">SMA Nusantara</div>
                                            <div class="text-sm text-gray-500">2,450 transaksi</div>
                                        </div>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Rp 4.250.000</div>
                                </div>
                            </li>
                            <li class="py-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <span class="text-green-800 font-medium">SMK</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">SMK Teknologi</div>
                                            <div class="text-sm text-gray-500">1,980 transaksi</div>
                                        </div>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Rp 3.850.000</div>
                                </div>
                            </li>
                            <li class="py-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                            <span class="text-yellow-800 font-medium">SMP</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">SMP Cendekia</div>
                                            <div class="text-sm text-gray-500">1,650 transaksi</div>
                                        </div>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Rp 2.750.000</div>
                                </div>
                            </li>
                            <li class="py-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                            <span class="text-red-800 font-medium">SD</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">SD Harapan</div>
                                            <div class="text-sm text-gray-500">1,240 transaksi</div>
                                        </div>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Rp 1.740.000</div>
                                </div>
                            </li>
                        </ul>
                        <div class="mt-6">
                            <a href="#" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Lihat Semua Sekolah
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutAdmin from '../../Layouts/Admin.vue';
import { Head } from '@inertiajs/vue3';

export default {
    layout: LayoutAdmin,
    components: {
        Head
    },

    props: {
        totalTransaction: Number,
        totalStudent: Number,
        totalClassroom: Number
    },

    data(props) {
        return {
            // Data untuk grafik dan statistik yang nantinya akan diambil dari API
            stats: {
                totalTransaksi: props.totalTransaction,
                totalSiswa: props.totalStudent,
                totalKelas: props.totalClassroom,
                pendapatanBulanan: 'Rp 3.240.000',
            },
            transaksiTerbaru: [
                // Nantinya diisi dari API
            ],
            topSekolah: [
                // Nantinya diisi dari API
            ]
        }
    },
    mounted() {
        // Di sini nanti bisa ditambahkan kode untuk inisialisasi grafik
        // dan mengambil data dari API
    }
}
</script>