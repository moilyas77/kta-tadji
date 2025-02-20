<script setup>
	import { ref, computed, onMounted } from 'vue';

	const { toast } = defineProps({
		toast: {
			type: Object,
			required: true
		}
	});

	const { type, message } = toast;

	let style = '';
	switch(type){
	case 'success':
		style = 'bg-success text-success-content';
		break;
	case 'error':
		style = 'bg-error text-error-content';
		break;
	case 'info':
		style = 'bg-info text-info-content';
		break;
	case 'warning':
		style = 'bg-warning text-warning-content';
		break;
	}

	const collapse = ref(false);

	const classes = computed(() => {
		return collapse.value ? style + ' p-2 rounded-full' : style + ' alert p-4 gap-2';
	});

	let action = null;
	const collapseAction = () => {
		action = setTimeout(() => collapse.value = true, 5000);
	};
	const toggle = () => {
		collapse.value = !collapse.value;
		if(!collapse.value){
			if(action){
				clearTimeout(action);
			}
			collapseAction();
		}
	};

	onMounted(() => {
		collapseAction();
	});
</script>

<template>
	<div @click="toggle()" :class="classes" class="transition-all flex alert w-fit">
		<svg v-if="type == 'info'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="pointer-events-none h-6 w-6 shrink-0 stroke-current">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
		</svg>
		<svg v-if="type == 'success'" xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
		</svg>
		<svg v-if="type == 'warning'" xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
		</svg>
		<svg v-if="type == 'error'" xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
		</svg>
		<span v-if="!collapse" id="toast-message" class="pointer-events-none max-w-52 w-max text-xs text-wrap text-left">
			{{ message }}
		</span>
	</div>
</template>