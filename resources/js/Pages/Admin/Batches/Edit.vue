<script setup>

import { Head, router, useForm } from '@inertiajs/vue3';
import LayoutAdmin from '../../../Layouts/Admin.vue';
import { inject, onMounted, reactive } from 'vue';
import { useToast } from 'vue-toastification';
import { useFormCrud } from '../../../Composables/useFormCrud.js';

defineOptions({
    layout: LayoutAdmin,
});

const props = defineProps({
    errors: Object,
    batch: Object
});

const toast = useToast();
const setTitle = inject('setTitle');
const setBreadcrumbs = inject('setBreadcrumbs');

const { form, submit } = useFormCrud({
    title: props.batch.title
});

const save = () => {
    submit({
        url: `/admin/batches/update/${props.batch.slug}`,
        method: 'put',
        resetOnSuccess: true,
    });
}

onMounted(() => {
    setTitle('Angkatan');
    setBreadcrumbs([
        {name: 'Angkatan', url: '/admin/batches'},
        {name: 'Edit Angkatan'}
    ]);
});

</script>

<template>
    <Head>
        <title>Edit Data Angkatan - SekolahPay</title>
    </Head>

    <div class="container mx-auto py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-6">Edit Data Angkatan</h2>
            
            <form @submit.prevent="save">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Nama Angkatan</label>
                    <input
                        id="title"
                        v-model="form.title"
                        type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{'border-red-500': form.errors.title}"
                        placeholder="Masukkan nama angkatan"
                    />
                    <div v-if="errors.title" class="text-red-500 text-sm mt-1">{{ errors.title }}</div>
                </div>
                
                <div class="flex items-center justify-end space-x-3 mt-6">
                    <button
                        type="button"
                        class="cursor-pointer px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100"
                        @click="$inertia.visit('/admin/batches')"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="cursor-pointer px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing"
                    >
                        {{ form.processing ? 'Menyimpan...' : 'Update' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>