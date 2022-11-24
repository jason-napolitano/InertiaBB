<template>
  <FaIcon size="sm" :icon="icon" />
</template>

<script setup lang="ts">
import { defineComponent } from 'vue'

defineProps({
  icon: {
    default: null,
  },
})
defineComponent({
  name: 'icon-component',
})
</script>

<style scoped lang="scss">
// ...
</style>
