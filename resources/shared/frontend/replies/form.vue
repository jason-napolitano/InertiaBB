<template>
  <div class="my-1">
    <label for="title">Title</label>
    <input type="text" id="title" class="form-control" />
  </div>
  <div class="my-1">
    <label for="content">Content</label>
    <Editor class="h-10rem" theme="snow" />
  </div>
  <div class="my-1">
    <span class="btn btn-secondary w-100"> Submit Reply </span>
  </div>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/inertia-vue3'
import { defineComponent } from 'vue'

const formData = useForm({
  content: null,
})

defineComponent({
  name: 'form-component',
})
</script>

<style scoped lang="scss">
// ...
</style>
