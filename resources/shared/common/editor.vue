<template>
  <QuillEditor class="h-6rem" theme="snow" :options="options" />
</template>

<script setup lang="ts">
import { QuillEditor } from '@vueup/vue-quill'
import { options } from '@/scripts/editor'
import '@/styles/_editor.scss'
</script>

<style scoped lang="scss">
// ...
</style>
