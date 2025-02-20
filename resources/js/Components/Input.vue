<script setup>
const model = defineModel();
</script>

<template>
  <input v-bind="$attrs" v-model="model" class="input input-sm input-bordered"/>
</template>

<style scoped>

</style>