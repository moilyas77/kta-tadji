<script setup>
import UserLayout from '../../Layouts/UserLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <UserLayout>
    <div class="py-32 w-full h-full flex flex-col items-center">
      <span class="text-3xl font-bold text-center">Selamat datang di Website Database Tadjimalela {{ $page.props.auth?.nama }} !</span>
      <Link :href="route('user.search-user.index')" class="mt-5 btn btn-primary">Cek Kartu Tanda Anggota</Link>
    </div>
  </UserLayout>
</template>

<style scoped>
</style>
