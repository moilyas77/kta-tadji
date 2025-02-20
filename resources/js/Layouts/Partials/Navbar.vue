<script setup>
import Logo from '@/Components/icons/Logo.vue';
import PhotoProfile from '@/Components/PhotoProfile.vue';
import LogoutModal from '@/Pages/Auth/LogoutModal.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const theme = defineModel('theme');
const appName = "Sistem Informasi Database PS. Tadjimalela";
const showLogoutModal = ref(false);
</script>
<template>
	<div class="navbar lg:px-6 bg-base-300 w-full min-h-14 max-h-14">
		<div class="flex-none lg:hidden">
			<label for="drawer" aria-label="open sidebar" class="btn btn-circle btn-ghost">
				<i class="ri-menu-line text-xl font-normal"></i>
			</label>
		</div>
		<div class="ml-6">
			<Logo />
		</div>
		<div class="mx-2 flex-1 px-2">{{ appName }}</div>

		<div class="hidden flex-none lg:block">
			<ul class="menu menu-horizontal gap-2">
				<slot name="menuNavbar"></slot>
				<li v-if="!$page.props.auth && $page.component != 'Auth/Login'">
					<Link href="/login" class="gap-2 bg-success text-success-content hover:bg-success/70"
						icon="login-circle">Login</Link>
				</li>
			</ul>
		</div>
		<div class="justify-end mx-2">
			<div class="tooltip tooltip-left lg:tooltip-bottom font-normal text-xl flex items-center"
				data-tip="Switch Theme">
				<label class="swap swap-rotate btn btn-circle btn-ghost">
					<input type="checkbox" v-model="theme" true-value="light" false-value="dark" />
					<i class="swap-on ri-sun-line text-xl font-normal"></i>
					<i class="swap-off ri-moon-line text-xl font-normal"></i>
				</label>
			</div>
		</div>
		<div v-if="$page.props.auth" class="hidden lg:dropdown ml-2 dropdown-end">
			<div class="tooltip tooltip-bottom" data-tip="Account">
				<div tabindex="0" role="button" class="btn btn-ghost btn-circle">
					<i class="ri-account-circle-line text-xl font-normal"></i>
				</div>
			</div>
			<ul tabindex="0" class="menu menu-sm dropdown-content bg-base-300 rounded-box z-[1] mt-3 w-52 p-2 shadow">
				<li>
					<div class="w-full flex flex-col items-center gap-2 pointer-events-none mb-2">
						<div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
							<PhotoProfile class="w-10"
								:src="$page.props.auth.foto ? '/' + $page.props.auth.foto : '/foto/default.png'">
							</PhotoProfile>
						</div>
						<span class="text-md font-semibold">
							{{ $page.props.auth.nama }}
						</span>
					</div>
				</li>
				<li>
					<Link v-if="!$page.component.startsWith('Account')" :href="route('profile.index')">
					Manage Account
					</Link>
				</li>
				<li>
					<span @click="showLogoutModal = true">Logout</span>
				</li>
			</ul>
		</div>
	</div>
	<LogoutModal v-if="showLogoutModal" @close="showLogoutModal = false" />
</template>