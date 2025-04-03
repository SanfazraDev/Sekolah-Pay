<script>

    export default {
        
    }

</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden">
      <!-- Header -->
      <div class="bg-blue-600 py-6">
        <h2 class="text-center text-2xl font-bold text-white">SPP Online</h2>
        <p class="text-center text-sm text-blue-100">Sistem Pembayaran SPP Online</p>
      </div>
      
      <!-- Login Form -->
      <slot/>
      
      <!-- Footer -->
      <div class="px-8 py-4 bg-gray-50 border-t border-gray-200">
        <p class="text-center text-xs text-gray-600">
          &copy; {{ new Date().getFullYear() }} SPP Online. All rights reserved.
        </p>
      </div>
    </div>
  </div>
</template>