<script setup>
	const props = defineProps({
		icon: String,
	});

	const active = false;
</script>
<template>
	<a class="flex gap-3">
		<template v-if="icon">
			<i :class="'ri-' + icon + '-line'"></i>
		</template>
		<span>
			<slot />
		</span>
	</a>
</template>
