<script setup>

import { useToast } from 'vue-toastification';
import { inject, onMounted, reactive } from 'vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { useFormCrud } from '../../../Composables/useFormCrud.js';
import LayoutAdmin from '../../../Layouts/Admin.vue';

defineOptions({
    layout: LayoutAdmin,
});

const props = defineProps({
    errors: Object,
    classrooms: Array,
});

const toast = useToast();
const setTitle = inject('setTitle');
const setBreadcrumbs = inject('setBreadcrumbs');

const { form, submit } = useFormCrud({
    classroom_id: '',
    name: '',
    nisn: '',
    email: '',
    phone: '',
    password: '',
    status: '',
});

// Handle form submission
const save = () => {
    submit({
        url: '/admin/students/store',
        method: 'post',
        resetOnSuccess: true
    });
}

// Lifecycle hooks
onMounted(() => {
    setTitle('Siswa');
    setBreadcrumbs([
        {name: 'Siswa', url: '/admin/students'},
        {name: 'Tambah Siswa'}
    ]);
});

</script>

<template>
    <Head>
        <title>Tambah Data Kelas - SekolahPay</title>
    </Head>

    <div class="container mx-auto py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-6">Tambah Data Siswa</h2>
            
            <form @submit.prevent="save">
                <div class="mb-4">
                    <label for="classroom_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kelas</label>
                    <select
                        id="classroom_id"
                        v-model="form.classroom_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{'border-red-500': form.errors.classroom_id}"
                    >
                        <option value="" hidden>-- Pilih Kelas --</option>
                        <option v-for="classroom in classrooms" :key="classroom.id" :value="classroom.id">
                            {{ classroom.name }}
                        </option>
                    </select>
                    <div v-if="errors.classroom_id" class="text-red-500 text-sm mt-1">{{ errors.classroom_id }}</div>
                </div>

                <div class="mb-4">
                    <label for="nisn" class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                    <input
                        id="nisn"
                        v-model="form.nisn"
                        type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{'border-red-500': form.errors.nisn}"
                        placeholder="Masukkan NISN ..."
                    />
                    <div v-if="errors.nisn" class="text-red-500 text-sm mt-1">{{ errors.nisn }}</div>
                </div>

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Siswa</label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{'border-red-500': form.errors.name}"
                        placeholder="Masukkan Nama Siswa ..."
                    />
                    <div v-if="errors.name" class="text-red-500 text-sm mt-1">{{ errors.name }}</div>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telpon</label>
                    <input
                        id="phone"
                        v-model="form.phone"
                        type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{'border-red-500': form.errors.phone}"
                        placeholder="Masukkan Nomor Telpon ..."
                    />
                    <div v-if="errors.phone" class="text-red-500 text-sm mt-1">{{ errors.phone }}</div>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input
                        id="email"
                        v-model="form.email"
                        type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{'border-red-500': form.errors.email}"
                        placeholder="Masukkan Email ..."
                    />
                    <div v-if="errors.email" class="text-red-500 text-sm mt-1">{{ errors.email }}</div>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Pilih Status</label>
                    <select
                        id="status"
                        v-model="form.status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{'border-red-500': form.errors.status}"
                    >
                        <option value="" hidden>-- Pilih Kelas --</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                    </select>
                    <div v-if="errors.status" class="text-red-500 text-sm mt-1">{{ errors.status }}</div>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{'border-red-500': form.errors.password}"
                        placeholder="Masukkan Password ..."
                    />
                    <div v-if="errors.password" class="text-red-500 text-sm mt-1">{{ errors.password }}</div>
                </div>
                
                <div class="flex items-center justify-end space-x-3 mt-6">
                    <button
                        type="button"
                        class="cursor-pointer px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                        @click="$inertia.visit('/admin/classrooms')"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="cursor-pointer px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing"
                    >
                        {{ form.processing ? 'Menyimpan...' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>