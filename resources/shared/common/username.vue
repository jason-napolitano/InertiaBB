<template>
  <Link
    :class="`no-underline font-italic text-${props.color ?? 'guardsman'}`"
    :href="route('profile.index', props.text ?? props.user.username)"
    v-text="`@${props.user.username}`"
  />
</template>

<script setup lang="ts">
import { UserInterface } from '@/scripts/types'

const props = defineProps<{
  user: UserInterface
  color?: string
  text?: string
}>()
</script>

<style scoped lang="scss">
// ...
</style>
