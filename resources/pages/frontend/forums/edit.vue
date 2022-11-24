<template layout="backend">
  <section class="row animate__animated animate__fadeIn">
    <div class="col-12">
      <h1 class="text-center">Here is an H1 tag for your page heading!</h1>
    </div>
  </section>
</template>

<script setup lang="ts">
// dependencies ---------------------------------
import { useForm } from '@inertiajs/inertia-vue3'

// component props ------------------------------
defineProps<{
  // ...
}>()

// form data ------------------------------------
const formData = useForm({
  // ...
})
</script>

<style scoped lang="scss">
// ...
</style>
