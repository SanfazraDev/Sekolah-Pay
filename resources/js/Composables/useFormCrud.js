import { useForm } from '@inertiajs/vue3'
import { useToast } from 'vue-toastification';

export function useFormCrud(initialValues = {}) {
    const form = useForm(initialValues)
    const toast = useToast();

    const submit = ({
        url,
        method = 'post',
        onSuccessRedirect = null,
        resetOnSuccess = false,
        extra = {},
    }) => {
        form.clearErrors()

        form[method](url, {
            ...extra,
            onSuccess: (page) => {
                const success = page.props?.session?.success;
                const error = page.props?.session?.error;

                if (success) toast.success(success);
                if (error) toast.error(error);
                
                if (resetOnSuccess) {
                    form.reset()
                }

                if (onSuccessRedirect) {
                    window.location.href = onSuccessRedirect
                }
            },
            onError: (errors) => {
                for (const key in errors) {
                    toast.error(errors[key])
                }
            },
            onFinish: () => {
                form.processing = false
            }
        })
    }

    return {
        form,
        submit,
    }
}
