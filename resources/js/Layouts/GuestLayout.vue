<script setup>
	import BaseLayout from '@/Layouts/BaseLayout.vue';
	import { Link } from '@inertiajs/vue3';
</script>
<template>
	<BaseLayout>
		<template #menuNavbar>
			<!-- <li>
				<Link href="/home" icon="home-2">Home</Link>
			</li>
			<li>
				<Link icon="product-hunt">Products</Link>
			</li>
			<li class="dropdown dropdown-hover dropdown-end">
				<Link tabindex="0" role="button" icon="service">Services</Link>
				<ul tabindex="0" class="menu dropdown-content bg-base-100 rounded-box w-64 p-2">
					<li>
						<Link>Branding</Link>
					</li>
					<li>
						<Link>Design</Link>
					</li>
					<li>
						<Link>Marketing</Link>
					</li>
				</ul>
			</li>
			<li class="dropdown dropdown-hover dropdown-end">
				<Link tabindex="0" role="button" icon="building-2">Company</Link>
				<ul tabindex="0" class="menu dropdown-content bg-base-100 rounded-box w-64 p-2">
					<li>
						<Link>About Us</Link>
					</li>
					<li>
						<Link>Contact</Link>
					</li>
					<li>
						<Link>Jobs</Link>
					</li>
				</ul>
			</li> -->
			<template v-if="$page.props.auth">
				<li>
					<Link href="/user" icon="user">User Page</Link>
				</li>
				<template v-if="$page.props.auth.role == 'admin'">
					<li>
						<Link href="/admin" icon="admin">Admin Page</Link>
					</li>
				</template>
			</template>
		</template>
		
		<template #menuDrawerSide>
			<!-- <li>
				<Link href="/home" icon="home-2">Home</Link>
			</li>
			<li>
				<Link icon="product-hunt">Products</Link>
			</li>
			<li>
				<details>
					<summary>
						<div class="flex gap-3">
							<i class="ri-service-line"></i>
							<span>Services</span>
						</div>
					</summary>
					<ul>
						<li>
							<Link>Branding</Link>
						</li>
						<li>
							<Link>Design</Link>
						</li>
						<li>
							<Link>Marketing</Link>
						</li>
					</ul>
				</details>
			</li>
			<li>
				<details>
					<summary>
						<div class="flex gap-3">
							<i class="ri-building-2-line"></i>
							<span>Company</span>
						</div>
					</summary>
					<ul>
						<li>
							<Link>About Us</Link>
						</li>
						<li>
							<Link>Contact</Link>
						</li>
						<li>
							<Link>Jobs</Link>
						</li>
					</ul>
				</details>
			</li> -->
			<template v-if="$page.props.auth">
				<li></li>
				<li>
					<Link href="/user" icon="user">User Page</Link>
				</li>
				<li v-if="$page.props.auth.role == 'admin'">
					<Link href="admin" icon="admin">Admin Page</Link>
				</li>
			</template>
		</template>

		<slot></slot>

		<!-- <template #footer>
			<nav>
				<h6 class="footer-title">Services</h6>
				<a class="link link-hover">Branding</a>
				<a class="link link-hover">Design</a>
				<a class="link link-hover">Marketing</a>
			</nav>
			<nav>
				<h6 class="footer-title">Company</h6>
				<a class="link link-hover">About us</a>
				<a class="link link-hover">Contact</a>
				<a class="link link-hover">Jobs</a>
			</nav>
			<nav>
				<h6 class="footer-title">Social</h6>
				<div class="grid grid-flow-col gap-4">
					<a>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
							<path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
						</svg>
					</a>
					<a>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
							<path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
						</svg>
					</a>
					<a>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
							<path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
						</svg>
					</a>
				</div>
			</nav>
		</template> -->
	</BaseLayout>
</template>