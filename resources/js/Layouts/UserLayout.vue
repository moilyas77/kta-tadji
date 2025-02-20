<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import { Link } from '@inertiajs/vue3';
import { usePaginationStore } from '../stores/pagination';

const paginationStore = usePaginationStore();
</script>
<template>
	<BaseLayout>
		<template #menuNavbar>
			<!-- <li>
				<Link href="/home" icon="group-3">Guest Page</Link>
			</li> -->
		</template>
		<template #menuDrawerSide>
			<li>
				<Link :href="route('user.dashboard')" :class="{ 'text-accent': $page.component == 'User/Dashboard' }">
				<i class="ri-dashboard-horizontal-line"></i>
				<span>Dashboard</span>
				</Link>
			</li>
			<li>
				<Link
					:href="paginationStore.getSearchKey ? route('user.search-user.index', { search: paginationStore.getSearchKey }) : route('user.search-user.index')"
					:class="{ 'text-accent': $page.component.startsWith('User/Search') }">
				<i class="ri-search-line"></i>
				<span>Cari Anggota</span>
				</Link>
			</li>
		</template>

		<div class="flex m-2 lg:m-4 gap-4">
			<div class="hidden rounded-md bg-base-100 shadow-lg lg:block min-w-72 py-4 px-2">
				<ul class="menu text-md">
					<li>
						<Link :href="route('user.dashboard')"
							:class="{ 'text-accent': $page.component == 'User/Dashboard' }">
						<i class="ri-dashboard-horizontal-line"></i>
						<span>Dashboard</span>
						</Link>
					</li>
					<li>
						<Link
							:href="paginationStore.getSearchKey ? route('user.search-user.index', { search: paginationStore.getSearchKey }) : route('user.search-user.index')"
							:class="{ 'text-accent': $page.component.startsWith('User/Search') }">
						<i class="ri-search-line"></i>
						<span>Cek ID Kartu Anggota</span>
						</Link>
					</li>
				</ul>
			</div>
			<div class="container min-h-screen mx-auto rounded-md bg-base-100 shadow-lg py-4 sm:px-2 md:px-4">
				<template v-if="$slots">
					<template v-if="$slots.contentHeader">
						<div class="mt-2 mb-6 px-4 w-full">
							<slot name="contentHeader"></slot>
						</div>
					</template>
					<slot></slot>
				</template>
			</div>
		</div>
	</BaseLayout>
</template>