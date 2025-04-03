<template>
  <div>
    <!-- Mobile Menu Overlay -->
    <div 
      v-if="mobileMenuOpen" 
      class="fixed inset-0 z-40 bg-black bg-opacity-50"
      @click="mobileMenuOpen = false"
    ></div>
    
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200">
      <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <!-- Left side -->
          <div class="flex">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
              <div class="flex items-center">
                <div class="bg-blue-600 text-white p-2 rounded-lg">
                  <span class="font-bold text-xl">SPP</span>
                </div>
                <span class="ml-2 font-semibold text-gray-800 text-lg hidden md:block">SPP Online</span>
              </div>
            </div>
            
            <!-- Desktop Navigation Links -->
            <div class="hidden md:ml-6 md:flex md:space-x-4">
              <Link 
                href="/dashboard" 
                class="px-3 py-2 rounded-md text-sm font-medium border-b-2"
                :class="[$page.url === '/dashboard' ? 'text-blue-600 border-blue-500' : 'text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300']"
              >
                Dashboard
              </Link>
              <Link 
                href="/pembayaran" 
                class="px-3 py-2 rounded-md text-sm font-medium border-b-2"
                :class="[$page.url === '/pembayaran' ? 'text-blue-600 border-blue-500' : 'text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300']"
              >
                Pembayaran
              </Link>
              <Link 
                href="/siswa" 
                class="px-3 py-2 rounded-md text-sm font-medium border-b-2"
                :class="[$page.url === '/siswa' ? 'text-blue-600 border-blue-500' : 'text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300']"
              >
                Data Siswa
              </Link>
              <Link 
                href="/laporan" 
                class="px-3 py-2 rounded-md text-sm font-medium border-b-2"
                :class="[$page.url === '/laporan' ? 'text-blue-600 border-blue-500' : 'text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300']"
              >
                Laporan
              </Link>
            </div>
          </div>
          
          <!-- Right side -->
          <div class="flex items-center">
            <!-- Notification bell -->
            <button class="p-2 rounded-full text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
              <span class="sr-only">View notifications</span>
              <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span v-if="notifications.length > 0" class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
              </div>
            </button>
            
            <!-- Profile dropdown -->
            <div class="ml-3 relative">
              <div>
                <button 
                  @click="profileMenuOpen = !profileMenuOpen" 
                  class="flex items-center max-w-xs text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                  id="user-menu"
                  aria-expanded="false"
                >
                  <span class="sr-only">Open user menu</span>
                  <div class="flex items-center">
                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center">
                      <span class="text-white font-medium">{{ userInitials }}</span>
                    </div>
                    <span class="ml-2 text-gray-700 hidden sm:block">{{ user.name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 text-gray-500 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </div>
                </button>
              </div>
              
              <!-- Profile dropdown menu -->
              <div 
                v-if="profileMenuOpen"
                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                role="menu"
                aria-orientation="vertical"
                aria-labelledby="user-menu"
              >
                <div class="py-1" role="none">
                  <Link href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profil</Link>
                  <Link href="/pengaturan" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Pengaturan</Link>
                  <button @click="logout" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</button>
                </div>
              </div>
            </div>
            
            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden ml-3">
              <button 
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
                <span class="sr-only">Open main menu</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Mobile Menu -->
      <div v-if="mobileMenuOpen" class="md:hidden">
        <div class="pt-2 pb-3 space-y-1">
          <Link 
            href="/dashboard" 
            class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium"
            :class="[$page.url === '/dashboard' ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700']"
            @click="mobileMenuOpen = false"
          >
            Dashboard
          </Link>
          <Link 
            href="/pembayaran" 
            class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium"
            :class="[$page.url === '/pembayaran' ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700']"
            @click="mobileMenuOpen = false"
          >
            Pembayaran
          </Link>
          <Link 
            href="/siswa" 
            class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium"
            :class="[$page.url === '/siswa' ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700']"
            @click="mobileMenuOpen = false"
          >
            Data Siswa
          </Link>
          <Link 
            href="/laporan" 
            class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium"
            :class="[$page.url === '/laporan' ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700']"
            @click="mobileMenuOpen = false"
          >
            Laporan
          </Link>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
          <div class="flex items-center px-4">
            <div class="flex-shrink-0">
              <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center">
                <span class="text-white font-medium">{{ userInitials }}</span>
              </div>
            </div>
            <div class="ml-3">
              <div class="text-base font-medium text-gray-800">{{ user.name }}</div>
              <div class="text-sm font-medium text-gray-500">{{ user.email }}</div>
            </div>
          </div>
          <div class="mt-3 space-y-1">
            <Link 
              href="/profile" 
              class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100"
              @click="mobileMenuOpen = false"
            >
              Profil
            </Link>
            <Link 
              href="/pengaturan" 
              class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100"
              @click="mobileMenuOpen = false"
            >
              Pengaturan
            </Link>
            <button 
              @click="logout" 
              class="w-full text-left block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100"
            >
              Logout
            </button>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

export default {
  components: { Link },
  
  setup() {
    const mobileMenuOpen = ref(false);
    const profileMenuOpen = ref(false);
    const notifications = ref([]);
    const page = usePage();
    
    const user = computed(() => page.props.auth.user);
    
    const userInitials = computed(() => {
      if (!user.value || !user.value.name) return '';
      return user.value.name
        .split(' ')
        .map(word => word[0].toUpperCase())
        .slice(0, 2)
        .join('');
    });
    
    const logout = () => {
      router.post('/logout');
    };
    
    // Close dropdown when clicking outside
    const handleClickOutside = (event) => {
      if (profileMenuOpen.value && !event.target.closest('#user-menu')) {
        profileMenuOpen.value = false;
      }
    };
    
    // Add event listener when component is mounted
    onMounted(() => {
      document.addEventListener('click', handleClickOutside);
    });
    
    // Remove event listener when component is unmounted
    onUnmounted(() => {
      document.removeEventListener('click', handleClickOutside);
    });
    
    return {
      mobileMenuOpen,
      profileMenuOpen,
      notifications,
      user,
      userInitials,
      logout,
      $page: page,
      onMounted
    };
  }
};
</script>