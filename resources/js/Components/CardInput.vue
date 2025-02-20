<script setup>
defineProps({
    label: String
})

</script>

<template>
  <div class="w-full flex flex-col gap-1 rounded-md bg-black/5 p-2 shadow-lg">
      <span v-if="label" class="ml-1 font-semibold">{{ label }}</span>
	<slot></slot>
</div>

</template>

<style scoped>

</style>