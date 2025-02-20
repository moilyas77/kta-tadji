<script setup>
import { ref, watch } from 'vue';
import DrawerSide from '@/Layouts/Partials/DrawerSide.vue';
import Navbar from '@/Layouts/Partials/Navbar.vue';
import Footer from '@/Layouts/Partials/Footer.vue';
import Toast from '@/Components/Toast.vue';

const theme = ref(sessionStorage.getItem('theme') ?? 'dark');

watch(theme, () => {
	sessionStorage.setItem('theme', theme.value);
});
</script>
<template>
	<div class="drawer" :data-theme="theme">
		<input id="drawer" type="checkbox" class="drawer-toggle" />
		<div class="drawer-content flex flex-col">
			<Navbar v-model:theme="theme">
				<template v-if="$slots.menuNavbar" #menuNavbar>
					<slot name="menuNavbar"></slot>
				</template>
			</Navbar>
			<div class="min-h-screen bg-base-200">
				<slot></slot>
			</div>
			<Footer v-if="$slots.footer" class="bg-base-300 text-base-content">
				<slot name="footer"></slot>
			</Footer>
			<Toast />
		</div>
		<DrawerSide toggleId="drawer" v-model:theme="theme">
			<template v-if="$slots.menuDrawerSide" #menuDrawerSide>
				<slot name="menuDrawerSide"></slot>
			</template>
		</DrawerSide>
	</div>
</template>