<script setup>
import { ref, onMounted } from 'vue';

const modal = ref(null);

onMounted(() => {
    modal.value.showModal();
});
</script>

<template>
    <dialog ref="modal" class="modal">
        <div class="modal-box overflow-y-auto">
            <button @click="$emit('close')" class="btn btn-sm btn-circle btn-outline absolute right-2 top-2">✕</button>
            <h3 class="text-lg font-bold">
                <slot name="title"></slot>
            </h3>
            <slot />
        </div>
    </dialog>
</template>

<style scoped></style>