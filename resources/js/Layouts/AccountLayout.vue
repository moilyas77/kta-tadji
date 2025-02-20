<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
	<BaseLayout>
		<template #menuNavbar>
			<li>
				<Link :href="route('dashboard')">
				<!-- <template v-if="$page.props.auth.role == 'admin'"> -->
					<i class="ri-dashboard-horizontal-line"></i>
					<span>Dashboard</span>
				<!-- </template> -->
				<!-- <template v-else>
					<i class="ri-home-line"></i>
					<span>Home</span>
				</template> -->
				</Link>
			</li>
		</template>
		<template #menuDrawerSide>
			<li>
				<Link :href="route('profile.index')" :class="{ 'text-accent': $page.component == 'Account/Profile' }">
				<i class="ri-id-card-line"></i>
				<span>Profile Detail</span>
				</Link>
			</li>
			<li>
				<Link :href="route('username-password.index')"
					:class="{ 'text-accent': $page.component == 'Account/UsernamePassword' }">
				<i class="ri-key-line"></i>
				<span>Username and Password</span>
				</Link>
			</li>
			<li></li>
			<li>
				<Link :href="route('dashboard')">
				<!-- <template v-if="$page.props.auth.role == 'admin'"> -->
					<i class="ri-dashboard-horizontal-line"></i>
					<span>Dashboard</span>
				<!-- </template> -->
				<!-- <template v-else>
					<i class="ri-home-line"></i>
					<span>Home</span>
				</template> -->
				</Link>
			</li>
		</template>

		<div class="flex m-2 lg:m-4 gap-4">
			<div class="hidden rounded-md bg-base-100 shadow-lg lg:block min-w-72 py-4 px-2">
				<ul class="menu text-md">
					<li>
						<Link :href="route('profile.index')"
							:class="{ 'text-accent': $page.component == 'Account/Profile' }">
						<i class="ri-id-card-line"></i>
						<span>Profile Detail</span>
						</Link>
					</li>
					<li>
						<Link :href="route('username-password.index')"
							:class="{ 'text-accent': $page.component == 'Account/UsernamePassword' }">
						<i class="ri-key-line"></i>
						<span>Username and Password</span>
						</Link>
					</li>
				</ul>
			</div>
			<div class="container min-h-screen mx-auto rounded-md bg-base-100 shadow-lg py-4 sm:px-2 md:px-4">
				<template v-if="$slots.contentHeader">
					<div class="mt-2 mb-6 px-4 w-full">
						<slot name="contentHeader"></slot>
					</div>
				</template>
				<slot></slot>
			</div>
		</div>
	</BaseLayout>
</template>