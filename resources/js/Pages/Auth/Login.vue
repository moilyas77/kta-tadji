<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
	username: '',
	password: ''
});

const submit = () => {
	form.post(route('login'), {
	onFinish: () => form.reset('password'),
	preserveScroll: true
});
}
</script>

<template>
	<GuestLayout>
		<div class="container w-full max-w-lg mx-auto p-10 mt-14">
			<form @submit.prevent="submit">
				<div class="p-8 rounded-lg shadow-xl bg-base-300 flex flex-col gap-8">
					<div>
						<label class="input input-bordered flex items-center justify-between gap-2">
							<i class="ri-user-line"></i>
							<input v-model="form.username" class="w-full" type="text" placeholder="Username" />
						</label>
						<InputError :message="form.errors.username" />
					</div>
					<div>
						<label class="input input-bordered flex items-center justify-between gap-2">
							<i class="ri-key-line"></i>
							<input class="w-full" v-model="form.password" type="password" placeholder="Password" />
						</label>
						<InputError :message="form.errors.password" />
					</div>
					<div class="flex justify-between">
						<label class="flex text-xs gap-2">
							<span class="my-auto">Remember me</span>
							<input type="checkbox" name="remember_me"
								class="checkbox checkbox-success checkbox-xs my-auto">
						</label>
						<button type="submit" class="btn btn-success justify-end">Login</button>
					</div>
					<!-- <div class="mx-auto flex flex-col items-center text-xs">
						<span>Don't have account ?</span>
						<span><a href="" class="link link-hover">Register</a></span>
					</div> -->
				</div>
			</form>
		</div>
	</GuestLayout>

</template>

<style scoped></style>