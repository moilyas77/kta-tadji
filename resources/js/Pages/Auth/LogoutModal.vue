<script setup>
import Modal from '@/Components/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import { usePaginationStore } from '../../stores/pagination';

const emit = defineEmits(['close']);

const form = useForm({});

const submit = () => {
    form.post(route('logout'), {
        onSuccess: () => {
            usePaginationStore().$reset();
        }
    });
}

</script>

<template>
    <Modal @close="emit('close')">
        <template #title>Logout</template>
        <div class="mt-6">
            <p>Are you sure want to Logout?</p>
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