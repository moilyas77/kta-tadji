<script setup>
import { Link, router } from '@inertiajs/vue3';
import PhotoProfile from '@/Components/PhotoProfile.vue';
import LogoutModal from '@/Pages/Auth/LogoutModal.vue';
import { ref } from 'vue';

defineProps({
	toggleId: String
});

const theme = defineModel('theme');
const profileDetail = false;
const showLogoutModal = ref(false);
</script>
<template>
	<div class="drawer-side lg:hidden">
		<label :for="toggleId" aria-label="close sidebar" class="drawer-overlay"></label>
		<div class="menu bg-base-200 min-h-full w-80">
			<label for="drawer" class="btn btn-circle btn-ghost mb-4">
				<i class="ri-close-line text-xl font-normal"></i>
			</label>
			<ul>
				<slot name="menuDrawerSide"></slot>
				<li></li>
				<li>
					<label class="w-full flex gap-2 justify-between">
						<i :class="theme == 'dark' ? 'ri-moon-line' : 'ri-sun-line'"></i>
						<span class="w-full">Dark Mode</span>
						<input type="checkbox" class="toggle toggle-xs toggle-accent" v-model="theme" true-value="light"
							false-value="dark">
					</label>
				</li>
				<template v-if="$page.props.auth">
					<li>
						<details>
							<summary>
								<div class="flex gap-2">
									<i class="ri-account-circle-line"></i>
									<span>Account</span>
								</div>
							</summary>
							<ul>
								<li>
									<div class="w-full flex flex-col items-center gap-2 pointer-events-none">
										<div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
											<PhotoProfile class="w-10"
												:src="$page.props.auth.foto ? '/' + $page.props.auth.foto : '/foto/default.png'"></PhotoProfile>
										</div>
										<span class="text-md font-semibold">
											{{ $page.props.auth.nama }}
										</span>
									</div>
								</li>
								<li v-if="!$page.component.startsWith('Account')">
									<Link :href="route('profile.index')">Manage Account</Link>
								</li>
								<li>
									<span @click="showLogoutModal = true">Logout</span>
								</li>
							</ul>
						</details>
					</li>
				</template>
				<template v-else-if="$page.component != 'Auth/Login'">
					<li>
						<Link href="/login" icon="login-circle">Login</Link>
					</li>
				</template>
			</ul>
		</div>
	</div>
	<LogoutModal v-if="showLogoutModal" @close="showLogoutModal = false" />
</template>