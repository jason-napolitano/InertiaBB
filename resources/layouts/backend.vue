<template>
  <!-- header -->
  <header class="container mt-6">
    <div class="row">
      <div class="col-12">
        <AppNavbar />
      </div>
    </div>
  </header>

  <!-- content -->
  <main class="container">
    <slot></slot>
  </main>

  <!-- footer -->
  <footer class="container mb-4">
    <section class="row">
      <div class="col-12">
        <AppFooter />

        <a
          href="#"
          class="btn btn-sm bg-deepocean text-offwhite scroll-to-top bg-gradient"
          v-text="`Top`"
        />
      </div>
    </section>
  </footer>
</template>

<script setup lang="ts">
/* ---------------------------------------------
 * Dependency imports
 * -------------------------------------------- */
import AppFooter from '@/shared/common/footer.vue'
import AppNavbar from '@/shared/common/navbar.vue'
import { flashNotification } from '@/utils/app'
import { onMounted } from 'vue'

// component mounting -------------------------------------
onMounted(() => {
  flashNotification()
})
</script>

<style scoped>
.scroll-to-top {
  position: fixed !important;
  bottom: 0.25rem !important;
  right: 3.7rem !important;
  z-index: 9999 !important;
  opacity: 0.9 !important;
}

@media (max-width: 568px) {
  .scroll-to-top {
    border-radius: 0 !important;
    width: 100% !important;
    bottom: 0 !important;
    right: 0 !important;
    left: 0 !important;
  }
}
</style>
