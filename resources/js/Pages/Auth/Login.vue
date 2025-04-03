<script>

    import { Head, router } from '@inertiajs/vue3';

    import LayoutAuth from '../../Layouts/Auth.vue';

    import { reactive, ref } from 'vue';

    import { useForm } from '@inertiajs/vue3';

    export default {

        layout: LayoutAuth,

        components: {
            Head
        },

        setup() {
            const form = reactive({
                email: '',
                password: '',
                remember: false
            });
            
            const showPassword = ref(false);
            const processing = ref(false);
            const errors = reactive({
                email: '',
                password: ''
            });
            
            const submit = () => {
                processing.value = true;
                
                // Reset errors
                errors.email = '';
                errors.password = '';

                router.post('/login', {
                    email: form.email,
                    password: form.password
                }, {
                    onFinish: () => {
                        processing.value = false
                    },
                    onError: (error) => {
                        if (error.email) errors.email = error.email;
                        if (error.password) errors.password = error.password;
                    }
                });
                
            };
            
            return {
                form,
                showPassword,
                processing,
                errors,
                submit
            };
        }
    };

</script>

<template>

    <Head>
        <title>Login Admin - SekolahPay</title>
    </Head>

     <div class="p-8">
        <h1 class="text-xl font-bold text-gray-700 mb-6">Login Akun</h1>
        
        <!-- Alert pesan error jika ada -->
        <div v-if="errors.email || errors.password" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          <div v-if="errors.email">{{ errors.email }}</div>
          <div v-if="errors.password">{{ errors.password }}</div>
        </div>
        
        <form @submit.prevent="submit">
          <!-- Email field -->
          <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Masukkan email Anda"
              required
            />
          </div>
          
          <!-- Password field -->
          <div class="mb-6">
            <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Password</label>
            <input
              id="password"
              v-model="form.password"
              :type="showPassword ? 'text' : 'password'"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Masukkan password Anda"
              required
            />
            <div class="flex justify-between items-center mt-2">
              <div class="flex items-center">
                <input 
                  id="show-password" 
                  type="checkbox" 
                  v-model="showPassword" 
                  class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                />
                <label for="show-password" class="ml-2 block text-sm text-gray-700">
                  Tampilkan password
                </label>
              </div>
              <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Lupa password?</a>
            </div>
          </div>
          
          <!-- Remember me -->
          <div class="mb-6">
            <div class="flex items-center">
              <input 
                id="remember-me" 
                type="checkbox" 
                v-model="form.remember" 
                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
              />
              <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                Ingat saya
              </label>
            </div>
          </div>
          
          <!-- Login button -->
          <div class="mb-4">
            <button 
              type="submit" 
              class="cursor-pointer w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
              :disabled="processing"
            >
              <span v-if="processing">Memproses...</span>
              <span v-else>Login</span>
            </button>
          </div>
        </form>
        
        <div class="text-center mt-6">
          <p class="text-sm text-gray-600">
            Belum punya akun?
            <a href="#" class="text-blue-600 hover:text-blue-800">Hubungi admin</a>
          </p>
        </div>
      </div>

</template>