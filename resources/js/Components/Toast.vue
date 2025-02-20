<script setup>
import ToastItem from '@/Components/ToastItem.vue';
</script>

<template>
	<div class="toast toast-end items-end">
		<ToastItem v-for="toast in $page.props.toasts" :toast="toast" :key="toast" />
	</div>
</template>