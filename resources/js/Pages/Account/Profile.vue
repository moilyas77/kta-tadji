<script setup>
import AccountLayout from '../../Layouts/AccountLayout.vue';
import PhotoProfile from '../../Components/PhotoProfile.vue';
import CardInput from '../../Components/CardInput.vue';
import Input from '../../Components/Input.vue';
import InputError from '../../Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const { user } = defineProps({
    user: {
        type: Object,
        required: true
    }
})

// console.log(user)

const form = useForm({
    nama: user.nama,
    tanggal_lahir: user.tanggal_lahir,
    tempat_lahir: user.tempat_lahir,
    agama: user.agama,
    alamat: user.alamat,
    unlat: user.unlat,
    foto: user.foto,
    tahun_angkatan: user.tahun_angkatan,
    photoDeleted: false
});


const foto = ref(null);

const handlePhotoChange = (event) => {
    const file = event.target.files[0];

    form.foto = file;
    if (file != null) {
        const reader = new FileReader();
        reader.onload = () => {
            foto.value = reader.result;
            event.target.value = null;
        }
        reader.readAsDataURL(file);
    }
}

const removePhoto = () => {
    if (user.foto) {
        form.photoDeleted = true;
    }
    foto.value = null;
    form.foto = '';
}

const submit = () => {
    if (form.foto == user.foto) {
        form.foto == '';
    }
    form.post(route('profile.update', user.id), {
        headers: {
            'Content-Type': 'multipart/form-data'
        },
        onSuccess: () => { },
        onError: () => { }
    })
}
</script>

<template>
    <AccountLayout>
        <div class="p-2 lg:px-4">
            <form @submit.prevent="submit">
                <div class="flex justify-center">
                    <img id="avatar" class="h-full max-h-48 aspect-square object-fill mask mask-circle"
                        :src="foto ? foto : form.foto ? '/' + form.foto : '/foto/default.png'" />
                </div>
                <div class="mx-auto mt-6 w-fit flex flex-col gap-2">
                    <div class="flex gap-2">
                        <label class="mx-auto w-fit bg-red btn btn-xs btn-outline">
                            Change Photo
                            <input @input="handlePhotoChange" type="file" class="hidden">
                        </label>
                        <template v-if="foto || form.foto">
                            <button @click="removePhoto" type="button" class="btn btn-xs btn-error">Remove
                                Photo</button>
                        </template>
                    </div>
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
                            <Input v-model="form.nama" type="text" />
                            <InputError v-if="form.errors.nama" :message="form.errors.nama" />
                        </CardInput>
                        <CardInput class="max-w-lg mx-auto" label="Agama">
                            <Input v-model="form.agama" type="text" />
                            <InputError v-if="form.errors.agama" :message="form.errors.agama" />
                        </CardInput>
                        <CardInput class="max-w-lg mx-auto" label="Tanggal Lahir">
                            <Input v-model="form.tanggal_lahir" type="date" />
                            <InputError v-if="form.errors.tanggal_lahir" :message="form.errors.tanggal_lahir" />
                        </CardInput>
                        <CardInput class="max-w-lg mx-auto" label="Tempat Lahir">
                            <Input v-model="form.tempat_lahir" type="text" />
                            <InputError v-if="form.errors.tempat_lahir" :message="form.errors.tempat_lahir" />
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
                            <textarea v-model="form.alamat" rows="3"
                                class="textarea textarea-bordered textarea-sm"></textarea>
                            <InputError v-if="form.errors.alamat" :message="form.errors.alamat" />
                        </CardInput>
                    </div>

                    <div class="flex flex-row-reverse w-full mt-10 px-4">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </AccountLayout>
</template>

<style scoped></style>