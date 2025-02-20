<script setup>
import { ref, watchEffect } from 'vue';
import Pagination from '../../../Components/Pagination.vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import { usePaginationStore } from '../../../stores/pagination';
import DeleteModal from './DeleteModal.vue';
import { Link, useForm } from '@inertiajs/vue3';

const { users } = defineProps({
  users: {
    type: Object,
    required: true
  }
})

const paginationStore = usePaginationStore();

const form = useForm({});
const searchKey = ref('');

const search = () => {
  const url = searchKey.value == '' ? route('users.index') : route('users.index', { search: searchKey.value });

  form.get(url, {
    onSuccess: () => {
      paginationStore.setSearchKey(searchKey.value);
    },
    onError: () => { },
    preserveScroll: true
  })
}

watchEffect(() => {
  paginationStore.setCurrentPage(users.current_page);
  searchKey.value = paginationStore.getSearchKey
})

const userDelete = ref(null);
</script>

<template>
  <AdminLayout>
    <template #contentHeader>
      <div class="flex w-full justify-between items-center">
        <h2 class="text-2xl font-semibold">Data Anggota</h2>
        <Link :href="route('users.create')" class="btn btn-sm btn-success justify-end"><i class="ri-add-line"></i>Tambah Data
        </Link>
      </div>
    </template>

    <div class="px-4 flex gap-4 flex-col xl:flex-row lg:justify-between  items-center xl:items-start">
      <form @submit.prevent="search">
        <div class="flex gap-1">
          <input v-model="searchKey" type="text" maxlength="14" class="input input-sm input-bordered "
            placeholder="Search by No. Anggota" />
          <button type="submit" class="btn btn-sm input-bordered h-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
              <path fill-rule="evenodd"
                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </form>

      <Pagination v-if="users.total > 0" :paginator="users" :key="users" />

    </div>
    <div class="overflow-x-auto mt-4 lg:mx-4">
      <table class="table table-zebra">
        <thead>
          <tr>
            <th>No</th>
            <th class="text-center">No. Anggota</th>
            <th>Nama</th>
            <th>Unit Latihan</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <template v-if="users.total > 0">
            <tr v-for="(user, i) in users.data" :key="user.id">
              <td>{{ (i + 1) + ((users.current_page - 1) * 10) }}</td>
              <td class="text-center">{{ user.no_anggota }}</td>
              <td>{{ user.nama }}</td>
              <td>{{ user.unlat }}</td>
              <td class="text-center">
                <div class="flex justify-center gap-2">
                  <div class="tooltip min-h-6 flex items-center" data-tip="Lihat Detail">
                    <Link class="btn btn-xs btn-circle btn-info font-normal" :href="route('users.show', user.id)">
                    <i class="ri-eye-line"></i>
                    </Link>
                  </div>
                  <div class="tooltip min-h-6 flex items-center" data-tip="Delete">
                    <button class="btn btn-xs btn-circle btn-error font-normal" @click="userDelete = user">
                      <i class="ri-delete-bin-line"></i>
                    </button>
                  </div>
                </div>
              </td>
            </tr>
          </template>
          <tr v-else>
            <td colspan="4" class="text-center">No data.</td>
          </tr>

        </tbody>
      </table>
    </div>
    <DeleteModal v-if="userDelete" :user="userDelete" @close="userDelete = null" />
  </AdminLayout>
</template>

<style scoped></style>