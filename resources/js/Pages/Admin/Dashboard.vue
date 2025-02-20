<script setup>
import AdminLayout from '../../Layouts/AdminLayout.vue';

defineProps({
  users: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <AdminLayout>
    <div class="p-6 rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-blue-100 p-4 rounded-lg flex items-center">
          <i class="ri-user-line text-3xl text-blue-500 mr-4"></i>
          <div class="text-gray-800">
            <p class="text-lg font-semibold">Anggota</p>
            <p>Total {{ users.total-1 }} Orang</p>
          </div>
        </div>
        <!-- <div class="bg-green-100 p-4 rounded-lg flex items-center">
          <i class="ri-shopping-cart-line text-3xl text-green-500 mr-4"></i>
          <div class="text-gray-800">
            <p class="text-lg font-semibold">Orders</p>
            <p>567</p>
          </div>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg flex items-center">
          <i class="ri-money-dollar-circle-line text-3xl text-yellow-500 mr-4"></i>
          <div class="text-gray-800">
            <p class="text-lg font-semibold">Revenue</p>
            <p>$12,345</p>
          </div>
        </div> -->
      </div>
    </div>
  </AdminLayout>
</template>

<style scoped>

</style>