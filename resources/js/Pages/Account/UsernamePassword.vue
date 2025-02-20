<script setup>
import { useForm } from '@inertiajs/vue3';
import CardInput from '../../Components/CardInput.vue';
import Input from '../../Components/Input.vue';
import InputError from '../../Components/InputError.vue';
import AccountLayout from '../../Layouts/AccountLayout.vue';

const { user } = defineProps({
  user: {
    type: Object,
    required: true
  }
})

const formUsername = useForm({
  username: user.username
});

const formPassword = useForm({
  password: '',
  password_confirmation: ''
});

const updateUsername = () => {
  formUsername.patch(route('username-password.update-username', user.id), {
    onSuccess: () => {},
    onError: () =>{},
    preserveScroll: true
  });
}

const updatePassword = () => {
  formPassword.patch(route('username-password.update-password', user.id), {
    onSuccess: () => {
      formPassword.reset();
    },
    onError: () =>{},
    preserveScroll: true
  });
}

</script>

<template>
  <AccountLayout>
    <div class="p-2 lg:px-4">
      <form @submit.prevent="updateUsername">
        <h3 class="w-fit text-lg px-4 py-2 mb-4 ml-4 border-b-2 border-base-content/50 font-semibold">Change Username
        </h3>
        <div class="grid grid-cols-1 xl:grid-cols-2 mx-auto gap-4">
          <CardInput class="max-w-lg mx-auto" label="Username">
            <Input v-model="formUsername.username" type="text" />
            <InputError v-if="formUsername.errors.username" :message="formUsername.errors.username" />
          </CardInput>
        </div>

        <div class="flex flex-row-reverse w-full mt-10 px-4">
          <button type="submit" class="btn btn-success">Update Username</button>
        </div>
      </form>

      <div class="divider my-6"></div>

      <form @submit.prevent="updatePassword">
        <h3 class="w-fit text-lg px-4 p-2 mb-4 ml-4 border-b-2 border-base-content/50 font-semibold">Reset Password</h3>
        <div class="grid grid-cols-1 xl:grid-cols-2 mx-auto gap-4">
          <CardInput class="max-w-lg mx-auto" label="New Password">
            <Input v-model="formPassword.password" type="password" />
            <InputError v-if="formPassword.errors.password" :message="formPassword.errors.password" />
          </CardInput>
          <CardInput class="max-w-lg mx-auto" label="Password Confirmation">
            <Input v-model="formPassword.password_confirmation" type="password" />
            <InputError v-if="formPassword.errors.password_confirmation" :message="formPassword.errors.password_confirmation" />
          </CardInput>
        </div>
        <div class="flex flex-row-reverse w-full mt-10 px-4">
          <button type="submit" class="btn btn-success">Update Password</button>
        </div>
      </form>
    </div>
  </AccountLayout>
</template>

<style scoped></style>