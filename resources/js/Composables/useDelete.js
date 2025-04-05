import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

export default function useDelete({ deleteUrl = (entity) => '', entityName = 'Item', onDeleted = () => {} }) {
  const isLoading = ref(false);
  const selectedEntity = ref(null);
  const showDeleteModal = ref(false);
  const errors = ref({});
  const toast = useToast();

  const confirmDelete = (entity) => {
    if (!entity) return;
    selectedEntity.value = entity;
    showDeleteModal.value = true;
  };

  const closeModal = () => {
    showDeleteModal.value = false;
    selectedEntity.value = null;
    errors.value = {};
  };

  const deleteEntity = () => {
    if (!selectedEntity.value) return;
    
    isLoading.value = true;
    
    router.delete(deleteUrl(selectedEntity.value), {
      onSuccess: () => {
        closeModal();
        onDeleted(); // biar komponen yang urus toast
      },
      onError: (err) => {
        errors.value = err;
        toast.error('Gagal menghapus data');
      },
      onFinish: () => {
        isLoading.value = false;
      }
    });
  };

  return {
    isLoading,
    selectedEntity,
    showDeleteModal,
    errors,
    confirmDelete,
    closeModal,
    deleteEntity,
  };
}