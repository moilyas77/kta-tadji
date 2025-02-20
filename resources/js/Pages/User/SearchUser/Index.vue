<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import UserLayout from '../../../Layouts/UserLayout.vue';
import { usePaginationStore } from '../../../stores/pagination';
import { ref, watchEffect } from 'vue';

const { user } = defineProps({
  user: Object,
})

const paginationStore = usePaginationStore();

const form = useForm({});
const searchKey = ref('');

const search = () => {
  const url = searchKey.value == '' ? route('user.search-user.index') : route('user.search-user.index', { search: searchKey.value });

  form.get(url, {
    onSuccess: () => {
      paginationStore.setSearchKey(searchKey.value);
    },
    onError: () => { },
    preserveScroll: true
  })
}

watchEffect(() => {
  searchKey.value = paginationStore.getSearchKey
})

</script>

<template>
  <UserLayout>
    <div class="py-20 px-10 flex flex-col gap-10 items-center">
      <span class="text-2xl font-semibold pb-2 px-10 border-b border-base-content/50">
        Silahkan Masukan No Anggota
      </span>
      <form @submit.prevent="search">
        <div class="flex w-72 gap-1">
          <input v-model="searchKey" type="text" class="flex-grow input input-md input-bordered "
            placeholder="No. Anggota" maxlength="14" />
          <button type="submit" class="btn btn-md input-bordered h-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
              <path fill-rule="evenodd"
                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </form>
      <div class="w-full">
        <table v-if="user" class="table table-zebra w-full">
          <thead>
            <tr>
              <th class="text-center">No. Anggota</th>
              <th>Nama</th>
              <th class="text-center">Lihat detail</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td class="text-center">{{ user.no_anggota }}</td>
                <td>{{ user.nama }}</td>
                <td class="text-center">
                  <div class="flex justify-center gap-2">
                    <div class="tooltip min-h-6 flex items-center" data-tip="Lihat Detail">
                      <Link class="btn btn-xs btn-circle btn-info font-normal" :href="route('user.search-user.show', user.id)">
                      <i class="ri-eye-line"></i>
                      </Link>
                    </div>
                  </div>
                </td>
              </tr>
          </tbody>
        </table>
        <div v-else-if="!user && paginationStore.getSearchKey != ''" class="text-center">
          Hasil pencarian dengan No. Anggota <span class="font-semibold underline">{{ searchKey }}</span> tidak ditemukan
        </div>
      </div>
    </div>
  </UserLayout>
</template>

<style scoped></style>