<script setup>
import Input from '../../../Components/Input.vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import InputError from '../../../Components/InputError.vue';
import CardInput from '../../../Components/CardInput.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { usePaginationStore } from '../../../stores/pagination';

const form = useForm({
    no_anggota: '',
    nama: '',
    tanggal_lahir: '',
    tempat_lahir: '',
    agama: '',
    alamat: '',
    unlat: '',
    tahun_angkatan: '',
    foto: '',
    withAccount: false,
    username: '',
    password: '',
});


const foto = ref(null);

const handlePhotoChange = (event) => {
    const file = event.target.files[0];
    form.foto = file;
    if (file != null) {
        const reader = new FileReader();
        reader.onload = () => {
            foto.value = reader.result;
            console.log(foto.value)
        }
        reader.readAsDataURL(file);
    }
}

const removePhoto = () => {
    foto.value = null;
    form.foto = '';
}

const submit = () => {
    form.post(route('users.store'), {
        headers: {
            'Content-Type': 'multipart/form-data'
        },
        onSuccess: () => {
            form.reset();
            foto.value = null;
        },
        onError: () => { }
    })
}

const paginationStore = usePaginationStore();
</script>

<template>
    <AdminLayout>
        <template #contentHeader>
            <div class="flex w-full gap-4">
                <Link :href="route('users.index', {
                    page: paginationStore.getCurrentPage,
                    search: paginationStore.getSearchKey
                })" class="btn btn-sm btn-neutral"><i class="ri-arrow-left-line"></i>Kembali
                </Link>
                <h2 class="text-2xl">Tambah Data Anggota</h2>
            </div>
        </template>

        <div class="p-2 lg:px-4">
            <form @submit.prevent="submit">
                <h3 class="w-fit text-lg px-4 py-2 mb-4 ml-4 border-b-2 border-base-content/50 font-semibold">Data Pribadi</h3>
                <div class="grid grid-cols-1 xl:grid-cols-2 mx-auto gap-4">
                    <CardInput class="max-w-lg mx-auto" label="No. Anggota (14 digit, ex: 01010160012024)">
                        <Input v-model="form.no_anggota" type="text" maxlength="14" pattern="\d{14}" />
                        <InputError v-if="form.errors.no_anggota" :message="form.errors.no_anggota" />
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Nama">
                        <Input v-model="form.nama" type="text" />
                        <InputError v-if="form.errors.nama" :message="form.errors.nama" />
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Tanggal Lahir">
                        <Input v-model="form.tanggal_lahir" type="date" />
                        <InputError v-if="form.errors.tanggal_lahir" :message="form.errors.tanggal_lahir" />
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Tempat Lahir">
                        <Input v-model="form.tempat_lahir" type="text" />
                        <InputError v-if="form.errors.tempat_lahir" :message="form.errors.tempat_lahir" />
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Agama">
                        <Input v-model="form.agama" type="text" />
                        <InputError v-if="form.errors.agama" :message="form.errors.agama" />
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Unlat">
                        <Input v-model="form.unlat" type="text" />
                        <InputError v-if="form.errors.unlat" :message="form.errors.unlat" />
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Tahun Angkatan">
                        <Input v-model="form.tahun_angkatan" type="number" min="1900" max="2099" step="1" />
                        <InputError v-if="form.errors.tahun_angkatan" :message="form.errors.tahun_angkatan" />
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto" label="Alamat">
                        <textarea v-model="form.alamat" rows="5"
                            class="textarea textarea-bordered textarea-sm"></textarea>
                        <InputError v-if="form.errors.alamat" :message="form.errors.alamat" />
                    </CardInput>
                    <CardInput class="max-w-lg mx-auto xl:col-start-2 xl:row-start-4 xl:row-span-2" label="Foto">
                        <div class="h-full flex justify-center">
                            <label v-if="!foto" class="btn btn-sm">
                                <span>Select Photo</span>
                                <Input @change="handlePhotoChange" type="file" accept="image/*" class="hidden" />
                            </label>
                            <div v-else class="flex flex-col gap-4">
                                <img :src="foto" class="h-full max-h-48 aspect-square object-fill mask mask-circle" />
                                <button @click="removePhoto" class="btn btn-sm btn-error">Remove Photo</button>
                            </div>
                            <InputError v-if="form.errors.foto && !foto" :message="form.errors.foto" />
                        </div>
                    </CardInput>
                </div>

                <label class="ml-4 my-10 flex items-center gap-4 cursor-pointer">
                    <span>Add Account to this User ?</span>
                    <input v-model="form.withAccount" type="checkbox" class="checkbox ">
                </label>

                <div v-if="form.withAccount">
                    <h3 class="w-fit text-lg px-4 p-2 mb-4 ml-4 border-b-2 border-base-content/50 font-semibold">User
                        Account</h3>
                    <div class="grid grid-cols-1 xl:grid-cols-2 mx-auto gap-4">
                        <CardInput class="max-w-lg mx-auto" label="Username">
                            <Input v-model="form.username" type="text" />
                            <InputError v-if="form.errors.username" :message="form.errors.username" />
                        </CardInput>
                        <CardInput class="max-w-lg mx-auto" label="Password">
                            <Input v-model="form.password" type="password" />
                            <InputError v-if="form.errors.password" :message="form.errors.password" />
                        </CardInput>
                    </div>
                </div>
                <div class="flex flex-row-reverse w-full mt-10 px-4">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<style scoped></style>