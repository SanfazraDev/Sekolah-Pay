<template>
  <div class="flex flex-col flex-grow">
    <!-- Sidebar User Info -->
    <!-- <div class="px-4 py-3 mb-5 border-b border-blue-700">
      <div class="flex items-center">
        <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center">
          <span class="text-white font-medium">{{ userInitials }}</span>
        </div>
        <div class="ml-3">
          <p class="text-sm font-medium text-white">{{ user.name }}</p>
          <p class="text-xs font-medium text-blue-200">{{ user.role }}</p>
        </div>
      </div>
    </div> -->
    
    <!-- Navigation Menu -->
    <nav class="flex-1 px-2 space-y-1">
      <!-- Dashboard -->
      <Link 
        href="/admin/dashboard" 
        class="group flex items-center px-3 py-2 text-sm font-medium rounded-md"
        :class="[isActive('/admin/dashboard') ? 'bg-zinc-700 text-white' : 'text-blue-100 hover:bg-blue-700']"
      >
        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Dashboard
      </Link>
      
      <!-- Transaksi Pembayaran -->
      <div>
        <button 
          @click="toggleMenu('pembayaran')" 
          class="w-full group flex items-center px-3 py-2 text-sm font-medium rounded-md"
          :class="[isActiveGroup('/admin/pembayaran') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
        >
          <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          Pembayaran
          <svg 
            class="ml-auto h-5 w-5 transform" 
            :class="{ 'rotate-90': openMenus.pembayaran }"
            xmlns="http://www.w3.org/2000/svg" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
        <div v-if="openMenus.pembayaran" class="mt-1 space-y-1 pl-10">
          <Link 
            href="/admin/pembayaran/entri" 
            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md"
            :class="[isActive('/admin/pembayaran/entri') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
          >
            Entri Pembayaran
          </Link>
          <Link 
            href="/admin/pembayaran/daftar" 
            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md"
            :class="[isActive('/admin/pembayaran/daftar') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
          >
            Daftar Transaksi
          </Link>
          <Link 
            href="/admin/pembayaran/riwayat" 
            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md"
            :class="[isActive('/admin/pembayaran/riwayat') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
          >
            Riwayat Pembayaran
          </Link>
        </div>
      </div>
      
      <!-- Data Master -->
      <div>
        <button 
          @click="toggleMenu('master')" 
          class="w-full group flex items-center px-3 py-2 text-sm font-medium rounded-md"
          :class="[isActiveGroup('/admin/master') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
        >
          <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
          </svg>
          Data Master
          <svg 
            class="ml-auto h-5 w-5 transform" 
            :class="{ 'rotate-90': openMenus.master }"
            xmlns="http://www.w3.org/2000/svg" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
        <div v-if="openMenus.master" class="mt-1 space-y-1 pl-10">
          <Link 
            href="/admin/master/siswa" 
            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md"
            :class="[isActive('/admin/master/siswa') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
          >
            Data Siswa
          </Link>
          <Link 
            href="/admin/master/kelas" 
            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md"
            :class="[isActive('/admin/master/kelas') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
          >
            Data Kelas
          </Link>
          <Link 
            href="/admin/master/spp" 
            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md"
            :class="[isActive('/admin/master/spp') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
          >
            Data SPP
          </Link>
        </div>
      </div>
      
      <!-- Laporan -->
      <div>
        <button 
          @click="toggleMenu('laporan')" 
          class="w-full group flex items-center px-3 py-2 text-sm font-medium rounded-md"
          :class="[isActiveGroup('/admin/laporan') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
        >
          <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          Laporan
          <svg 
            class="ml-auto h-5 w-5 transform" 
            :class="{ 'rotate-90': openMenus.laporan }"
            xmlns="http://www.w3.org/2000/svg" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
        <div v-if="openMenus.laporan" class="mt-1 space-y-1 pl-10">
          <Link 
            href="/admin/laporan/harian" 
            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md"
            :class="[isActive('/admin/laporan/harian') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
          >
            Laporan Harian
          </Link>
          <Link 
            href="/admin/laporan/bulanan" 
            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md"
            :class="[isActive('/admin/laporan/bulanan') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
          >
            Laporan Bulanan
          </Link>
          <Link 
            href="/admin/laporan/tahunan" 
            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md"
            :class="[isActive('/admin/laporan/tahunan') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
          >
            Laporan Tahunan
          </Link>
        </div>
      </div>
      
      <!-- Pengguna -->
      <Link 
        href="/admin/pengguna" 
        class="group flex items-center px-3 py-2 text-sm font-medium rounded-md"
        :class="[isActive('/admin/pengguna') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
      >
        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        Pengguna
      </Link>
      
      <!-- Pengaturan -->
      <Link 
        href="/admin/pengaturan" 
        class="group flex items-center px-3 py-2 text-sm font-medium rounded-md"
        :class="[isActive('/admin/pengaturan') ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-zinc-700']"
      >
        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Pengaturan
      </Link>
    </nav>
    
    <!-- App Version -->
    <div class="px-4 py-3 mt-auto">
      <p class="text-xs text-blue-200">SPP Online v1.0.0</p>
    </div>
  </div>
</template>

<script>
import { ref, computed, reactive } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

export default {
  components: {
    Link
  },
  
  setup() {
    const page = usePage();
    const user = computed(() => page.props.auth.user);
    
    const openMenus = reactive({
      pembayaran: false,
      master: false,
      laporan: false
    });
    
    // Automatically expand menu based on current URL
    const currentUrl = computed(() => page.url);
    
    // Initialize expanded menus based on current URL
    if (currentUrl.value.includes('/admin/pembayaran')) {
      openMenus.pembayaran = true;
    } else if (currentUrl.value.includes('/admin/master')) {
      openMenus.master = true;
    } else if (currentUrl.value.includes('/admin/laporan')) {
      openMenus.laporan = true;
    }
    
    const userInitials = computed(() => {
      if (!user.value || !user.value.name) return '';
      return user.value.name
        .split(' ')
        .map(word => word[0].toUpperCase())
        .slice(0, 2)
        .join('');
    });
    
    const toggleMenu = (menu) => {
      openMenus[menu] = !openMenus[menu];
    };
    
    const isActive = (path) => {
      return currentUrl.value === path;
    };
    
    const isActiveGroup = (path) => {
      return currentUrl.value.startsWith(path);
    };
    
    return {
      user,
      userInitials,
      openMenus,
      toggleMenu,
      isActive,
      isActiveGroup
    };
  }
};
</script>