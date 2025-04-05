import { ref, watch } from 'vue';

export default function useDebounce(sourceRef, callback, delay = 500) {
    const timeout = ref(null);

    watch(sourceRef, (newValue) => {
        if (timeout.value) {
            clearTimeout(timeout.value);
        }

        timeout.value = setTimeout(() => {
            callback(newValue);
        }, delay);
    });
}