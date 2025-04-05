<template>
  <!-- Container utama dengan background abu-abu -->
  <div class="h-screen flex overflow-hidden bg-gray-100">
    <!-- Overlay Sidebar untuk Mobile - muncul ketika sidebar terbuka -->
    <div 
      v-if="sidebarOpen" 
      class="fixed inset-0 z-40 md:hidden"
      @click="sidebarOpen = false"
    >
      <!-- Background overlay semi-transparan -->
      <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
    </div>

    <!-- Sidebar untuk Mobile - muncul dari kiri saat tombol hamburger diklik -->
    <div 
      v-if="sidebarOpen" 
      class="fixed inset-y-0 left-0 flex flex-col z-40 w-64 bg-zinc-800 transform transition ease-in-out duration-300"
    >
      <!-- Header sidebar dengan logo dan tombol tutup -->
      <div class="h-16 flex items-center justify-between px-4 bg-zinc-600">
        <div class="flex items-center">
          <div class="text-white font-bold text-xl">SekolahPay</div>
        </div>
        <!-- Tombol untuk menutup sidebar di mobile -->
        <button 
          @click="sidebarOpen = false" 
          class="h-8 w-8 flex items-center justify-center rounded-md text-blue-200 hover:text-white focus:outline-none"
        >
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      
      <!-- Area konten sidebar dengan scroll -->
      <div class="flex-1 overflow-y-auto pt-5 pb-4">
        <SidebarContent />
      </div>
    </div>

    <!-- Sidebar untuk Desktop - selalu terlihat pada layar medium ke atas -->
    <div class="hidden md:flex md:flex-shrink-0">
      <div class="flex flex-col w-64 bg-zinc-800">
        <!-- Header sidebar desktop -->
        <div class="h-16 flex items-center px-4 bg-zinc-600">
          <div class="text-white font-bold text-xl">SekolahPay</div>
        </div>
        <!-- Area konten sidebar desktop -->
        <div class="flex-1 flex flex-col overflow-y-auto pt-5 pb-4">
          <SidebarContent />
        </div>
      </div>
    </div>
    
    <!-- Area Konten Utama -->
    <div class="flex flex-col w-0 flex-1 overflow-hidden">
      <!-- Header navbar dengan tombol sidebar, judul halaman, dan menu profil -->
      <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
        <!-- Tombol hamburger untuk membuka sidebar (hanya pada mobile) -->
        <button
          @click="sidebarOpen = true"
          class="md:hidden px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
        >
          <span class="sr-only">Open sidebar</span>
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
        
        <!-- Konten header dengan judul dan tombol aksi -->
        <div class="flex-1 px-4 flex justify-between">
          <!-- Judul halaman -->
          <div class="flex-1 flex items-center">
            <h1 class="text-lg font-semibold text-gray-800">{{ title }}</h1>
          </div>
          <!-- Area icons notifikasi dan menu profil -->
          <div class="ml-4 flex items-center md:ml-6">
            <!-- Icon lonceng notifikasi -->
            <button class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              <span class="sr-only">View notifications</span>
              <div class="relative">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <!-- Indikator notifikasi baru jika ada -->
                <span v-if="notifications.length > 0" class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
              </div>
            </button>

            <!-- Dropdown menu profil pengguna -->
            <div class="ml-3 relative">
              <div>
                <!-- Tombol untuk menampilkan dropdown profil -->
                <button
                  @click="profileDropdownOpen = !profileDropdownOpen"
                  class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                  id="user-menu"
                  aria-expanded="false"
                >
                  <span class="sr-only">Open user menu</span>
                  <div class="flex items-center">
                    <!-- Avatar pengguna dengan inisial -->
                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center">
                      <span class="text-white font-medium">{{ userInitials }}</span>
                    </div>
                    <!-- Nama pengguna (hanya muncul pada layar sm ke atas) -->
                    <span class="ml-2 text-gray-700 hidden sm:block">{{ user.name }}</span>
                    <!-- Ikon dropdown -->
                    <svg class="ml-1 h-4 w-4 text-gray-400 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </div>
                </button>
              </div>
              
              <!-- Panel dropdown profil - muncul saat tombol profil diklik -->
              <div
                v-if="profileDropdownOpen"
                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-blue-500 ring-opacity-5 focus:outline-none"
                role="menu"
                aria-orientation="vertical"
                aria-labelledby="user-menu"
              >
                <!-- Opsi menu profil -->
                <Link href="/admin/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100 hover:text-blue-700" role="menuitem">Profil Saya</Link>
                <Link href="/admin/pengaturan" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100 hover:text-blue-700" role="menuitem">Pengaturan</Link>
                <!-- <Link href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100 hover:text-blue-700" role="menuitem" method="post">Logout</Link> -->
                <Link href="/logout" class="cursor-pointer w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100 hover:text-blue-700" role="menuitem" method="post">Keluar</Link>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Area Konten Utama - berisi konten halaman yang dinamis -->
      <main class="flex-1 relative overflow-y-auto focus:outline-none">
        <div class="py-6">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-4">
            <!-- Navigasi breadcrumb -->
            <div class="mb-4 text-sm text-gray-500 mx-2">
              <span v-for="(crumb, index) in breadcrumbs" :key="index">
                <Link v-if="crumb.url" :href="crumb.url" class="hover:text-blue-600">{{ crumb.name }}</Link>
                <span v-else>{{ crumb.name }}</span>
                <span v-if="index < breadcrumbs.length - 1" class="mx-2">/</span>
              </span>
            </div>

            <!-- Area untuk menampilkan pesan status/flash -->
            <div v-if="status" class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
              <p>{{ status }}</p>
            </div>

            <!-- Konten halaman utama (melalui slot) -->
            <div class="">
              <slot></slot>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import { ref, computed, onMounted, onUnmounted, provide } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';
import SidebarContent from '../Components/Sidebar.vue';

export default {
  // Daftar komponen yang digunakan
  components: {
    Link, // Komponen Link dari Inertia.js
    SidebarContent // Komponen sidebar yang diimpor dari file terpisah
  },
  
  // Setup function menggunakan Composition API Vue 3
  setup() {
    // Reactive state dengan ref
    const sidebarOpen = ref(false); // State untuk sidebar (terbuka/tertutup)
    const profileDropdownOpen = ref(false); // State untuk dropdown profil
    const notifications = ref([]); // Array untuk notifikasi
    
    // Mengakses Inertia shared data/props
    const page = usePage();
    
    // State reaktif untuk judul dan breadcrumbs dinamis
    const title = ref('Dashboard');
    const breadcrumbs = ref([{ name: 'Dashboard', url: '/admin/dashboard' }]);
    
    // Computed properties
    const user = computed(() => page.props.auth.user); // Data pengguna dari Inertia props
    const status = computed(() => page.props.flash?.status); // Pesan flash/status dari server
    
    // Membuat inisial dari nama pengguna (2 huruf pertama)
    const userInitials = computed(() => {
      if (!user.value || !user.value.name) return '';
      return user.value.name
        .split(' ')
        .map(word => word[0].toUpperCase())
        .slice(0, 2)
        .join('');
    });
    
    // Fungsi untuk logout
    const logout = () => {
      router.post('/logout'); // Memanggil route logout dengan method POST
    };
    
    // Method untuk mengupdate judul dan breadcrumbs
    const setTitle = (newTitle) => {
      title.value = newTitle;
    };
    
    const setBreadcrumbs = (newBreadcrumbs) => {
      breadcrumbs.value = newBreadcrumbs;
    };
    
    // Menyediakan method ini ke komponen anak
    provide('setTitle', setTitle);
    provide('setBreadcrumbs', setBreadcrumbs);
    
    // Fungsi untuk menutup dropdown saat mengklik di luar area dropdown
    const handleClickOutside = (event) => {
      if (profileDropdownOpen.value && !event.target.closest('#user-menu')) {
        profileDropdownOpen.value = false;
      }
    };
    
    // Lifecycle hooks
    onMounted(() => {
      // Menambahkan event listener saat komponen di-mount
      document.addEventListener('click', handleClickOutside);
    });
    
    onUnmounted(() => {
      // Membersihkan event listener saat komponen di-unmount
      document.removeEventListener('click', handleClickOutside);
    });
    
    // Mengembalikan semua state dan fungsi yang akan digunakan di template
    return {
      sidebarOpen,
      profileDropdownOpen,
      notifications,
      user,
      userInitials,
      status,
      logout,
      title,
      breadcrumbs
    };
  }
};
</script>