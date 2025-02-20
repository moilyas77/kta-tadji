<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <p v-show="message" class="mt-2 text-sm text-error">{{ message }}</p>
</template>