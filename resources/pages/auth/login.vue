<template layout="auth">
  <section id="login-form">
    <LoginForm :errors="errors" />
  </section>
</template>

<script setup lang="ts">
// component imports --------------------------------------
import LoginForm from '@/shared/common/auth/forms/login.vue'

// component props ----------------------------------------
defineProps<{
  errors: object
}>()
</script>
