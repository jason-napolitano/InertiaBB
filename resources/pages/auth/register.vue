<template layout="auth">
  <section id="login-form">
    <RegisterForm :errors="errors" />
  </section>
</template>

<script setup lang="ts">
// component imports --------------------------------------
import RegisterForm from '@/shared/common/auth/forms/register.vue'

// component props ----------------------------------------
defineProps<{
  errors: object
}>()
</script>
