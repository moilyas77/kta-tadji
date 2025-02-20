<script setup>
import { Link } from '@inertiajs/vue3';
import CardInput from '../../../Components/CardInput.vue';
import UserLayout from '../../../Layouts/UserLayout.vue';

const { user } = defineProps({
    user: {
        type: Object,
        required: true
    }
})

const back = () => {
    window.history.back();
}
</script>

<template>
    <UserLayout>
        <template #contentHeader>
            <div class="flex items-center w-full gap-4">
                <button class="btn btn-sm btn-neutral" @click="back">
                    <i class="ri-arrow-left-line"></i>Back
                </button>
                <h2 class="text-2xl font-semibold">Detail Anggota</h2>
            </div>
        </template>
        <div class="p-2 lg:px-4">
            <div class="flex justify-center">
                <img id="avatar" class="h-full max-h-48 aspect-square object-fill mask mask-circle"
                    :src="user.foto ? '/' + user.foto : '/foto/default.png'" />
            </div>
            <div class="my-4 flex flex-col gap-1 items-center">
                <span v-if="user.role == 'admin'" class="font-semibold px-4 rounded-full bg-base-200">Admin</span>
                <template v-else>
                    <span>No. Anggota</span>
                    <span class="font-semibold px-4 rounded-full bg-base-200">{{ user.no_anggota }}</span>
                </template>
            </div>
            <div class="p-2 lg:px-4">
                <div class="grid grid-cols-1 xl:grid-cols-2 mx-auto gap-4">
                    <CardInput class="max-w-lg mx-auto" label="Nama">
                        <span class="input input-sm input-bordered">{{ user.nama }}</span>
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Agama">
                        <span class="input input-sm input-bordered">{{ user.agama ?? '-' }}</span>
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Tanggal Lahir">
                        <span class="input input-sm input-bordered">{{ user.tanggal_lahir ?? '-' }}</span>
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Tempat Lahir">
                        <span class="input input-sm input-bordered">{{ user.tempat_lahir ?? '-' }}</span>
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Unlat">
                        <span class="input input-sm input-bordered">{{ user.unlat ?? '-' }}</span>
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Tahun Angkatan">
                        <span class="input input-sm input-bordered">{{ user.tahun_angkatan ?? '-' }}</span>
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Alamat">
                        <span class="input input-sm input-bordered">{{ user.alamat ?? '-' }}</span>
                    </CardInput>
                </div>

                <div v-if="user.username == $page.props.auth?.username" class="flex flex-row-reverse w-full mt-10 px-4">
                    <Link :href="route('user.search-user.index')" type="button" class="btn btn-info">Kembali</Link>
                </div>
            </div>
        </div>
    </UserLayout>
</template>

<style scoped></style>