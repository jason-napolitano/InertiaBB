<template>
  <main class="container">
    <!-- content -->
    <section class="row">
      <div
        class="col-sm-12 sm:col-offset-0 col-md-10 md:col-offset-1 col-lg-8 lg:col-offset-2 my-4 animate__animated animate__fadeIn"
      >
        <div class="card">
          <div class="card-header text-center text-lg">
            <span class="">{{ title }} Authentication</span>
          </div>
          <div class="card-body">
            <section class="alert alert-info text-justify">
              You must be a registered member to participate in these forums.
              Please enter your member credentials below to get involved in your
              favorite discussions
            </section>
            <section class="">
              <slot></slot>
            </section>

            <section class="text-center mt-3">
              <span class="btn-group btn-group-sm w-100">
                <Link :href="route('login.index')" class="btn text-concrete">
                  Are you already registered? Login here
                </Link>
                <Link :href="route('register.index')" class="btn text-concrete">
                  Do you need to register? Go here
                </Link>
              </span>
            </section>
          </div>
        </div>
      </div>
    </section>
    <section class="row">
      <div
        class="col-sm-12 sm:col-offset-0 col-md-10 md:col-offset-1 col-lg-8 lg:col-offset-2 animate__animated animate__fadeIn"
      >
        <Footer />
      </div>
    </section>
  </main>
</template>

<script setup lang="ts">
/* ---------------------------------------------
 * Dependency imports
 * -------------------------------------------- */
import Footer from '@/shared/common/footer.vue'
import { flashNotification } from '@/utils/app'
import { title } from '@/utils/app'
import { onMounted } from 'vue'

// component mounting -------------------------------------
onMounted(() => {
  flashNotification()
})
</script>

<style scoped lang="scss">
@import '../styles/_colors.scss';
.auth-bg {
  background: url('/storage/auth-bg.jpg') center center no-repeat;
  min-height: 100vh !important;
  border-right: 1px solid $color-silver;
  background-size: cover;
  min-width: 10rem;
}

.divider {
  border-top: 1px solid $color-silver !important;
  margin-top: 0.755rem !important;
  height: 1rem;
}

.heading {
  padding-bottom: 0.5rem;
  margin-bottom: 0.75rem;
}
</style>
