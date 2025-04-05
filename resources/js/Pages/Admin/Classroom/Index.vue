<script setup>

// Import Vue and Inertia
import { ref, onMounted, inject } from 'vue';
import { useToast } from 'vue-toastification';
import { Head, router, Link } from '@inertiajs/vue3';
import LayoutAdmin from '../../../Layouts/Admin.vue';
import useDebounce from '../../../Composables/useDebounce.js';
import Pagination from '../../../Components/Pagination.vue';
import useDelete from '../../../Composables/useDelete.js';

// Layout khusus
defineOptions({
  layout: LayoutAdmin,
});

// Props
const props = defineProps({
  auth: Object,
  classrooms: Object,
  errors: Object,
  session: Object,
});

// Search state
const search = ref(new URLSearchParams(window.location.search).get('search'));

// Inject
const setTitle = inject('setTitle');
const setBreadcrumbs = inject('setBreadcrumbs');

// Toast
const toast = useToast();

// Handle search
const handleSearch = () => {
  router.get('/admin/classrooms', { search: search.value },
    {
      preserveState: true,
      preserveScroll: true,
      only: ['classrooms'],
    }
  );
};

// Pakai debounce
useDebounce(search, handleSearch, 500);

// Composable delete
const {
  isLoading,
  selectedEntity: selectedBatch,
  showDeleteModal,
  errors: deleteErrors,
  confirmDelete,
  closeModal,
  deleteEntity: deleteBatch,
} = useDelete({
  deleteUrl: (classroom) => `/admin/classrooms/delete/${classroom.slug}`,
  onDeleted: () => {
    if (props.session?.success) {
      toast.success(props.session.success);
    } else if (props.session?.error) {
      toast.error(props.session.error);
    }
  },
});

// Lifecycle
onMounted(() => {
  setTitle('Kelas');
  setBreadcrumbs([{ name: 'Kelas', url: '/admin/classrooms' }]);
});

</script>

<template>
    <Head>
        <title>Kelas - SekolahPay</title>
    </Head>
    
    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Kelas</h1>
            <div class="flex space-x-2">
                <form @submit.prevent="handleSearch">
                    <div class="relative">
                        <input 
                            type="text" 
                            v-model="search" 
                            placeholder="Cari angkatan..." 
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        <button class="absolute right-3 top-2.5 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
                <Link href="/admin/classrooms/create" class="cursor-pointer px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kelas
                </Link>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-lg shadow overflow-hidden p-3">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-if="classrooms.data.length == 0">
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data Kelas</td>
                    </tr>
                    <tr v-for="(classroom, index) in classrooms.data" :key="classroom?.id || index" class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ classroom?.name || '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <Link :href="`/admin/classrooms/edit/${classroom.slug}`" class="cursor-pointer text-blue-600 hover:text-blue-900 bg-blue-100 p-2 rounded" :disabled="!classroom">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </Link>
                                <button 
                                    @click="classroom && confirmDelete(classroom)" 
                                    class="cursor-pointer text-red-600 hover:text-red-900 bg-red-100 p-2 rounded"
                                    :disabled="!classroom"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4 flex justify-between items-center">
                <div class="text-sm text-gray-700 ms-1">
                    Menampilkan {{ classrooms.meta.from }} - {{ classrooms.meta.to }} dari {{ classrooms.meta.total }} data
                </div>
                <Pagination :links="classrooms.links" align="right" />
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-red-600">Konfirmasi Hapus</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700">Apakah Anda yakin ingin menghapus kelas <span class="font-semibold">{{ selectedBatch?.name || '' }}</span>?</p>
                    <p class="text-red-500 text-sm mt-2">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-2 rounded-b-lg">
                    <button 
                        @click="closeModal" 
                        class="cursor-pointer px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500"
                    >
                        Batal
                    </button>
                    <button 
                        @click="deleteBatch" 
                        class="cursor-pointer px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                        :disabled="isLoading"
                    >
                        {{ isLoading ? 'Menghapus...' : 'Hapus' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>