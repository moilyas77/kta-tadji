<script setup>
import Modal from '@/Components/Modal.vue';
import { usePaginationStore } from '@/stores/pagination';
import { useForm } from '@inertiajs/vue3';

const { user } = defineProps({
    user: {
        type: Object,
        required: true
    }
})

const emit = defineEmits(['close']);

const form = useForm({});

const paginationStore = usePaginationStore();
const submit = () => {
    form.delete(route('users.destroy', {
        user: user.id,
        page: paginationStore.getCurrentPage,
        search: paginationStore.getSearchKey
    }), {
        onSuccess: () => { 
            emit('close');
         },
        preserveScroll: true
    });
}
</script>

<template>
    <Modal @close="emit('close')">
        <template #title>Hapus Data</template>
        <div class="mt-6">
            <p>Apakah kamu yakin akan menghapus  <strong>{{ user.nama }}</strong> ?</p>
            <form @submit.prevent="submit">
            <div class="flex justify-end mt-4">
                <div class="flex gap-2 w-1/2">
                    <button autofocus type="button" @click="emit('close')" class="flex-1 btn btn-neutral">Cancel</button>
                    <button type="submit" class="flex-1 btn btn-error">Yes</button>
                </div>
            </div>
            </form>
        </div>
    </Modal>
</template>

<style scoped></style>