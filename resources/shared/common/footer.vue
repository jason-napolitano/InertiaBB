<template>
  <!-- section -->
  <section class="row">
    <!-- col -->
    <div class="col-12">
      <div class="text-center border-top-1 border-silver pt-3">
        <div class="links">
          <a target="_blank" href="https://laravel.com">Laravel 9</a>
          <a target="_blank" href="https://getbootstrap.com">Bootstrap</a>
          <a target="_blank" href="https://element-plus.org/">Element UI</a>
          <a target="_blank" href="https://fontawesome.com/">Font Awesome</a>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </section>
  <!-- ./section -->

  <!-- section -->
  <section class="row">
    <!-- col -->
    <div class="col-12">
      <div class="text-center">
        <div class="links text-xs">
          <a target="_blank" href="https://vitejs.dev/"> Vite</a>
          <a target="_blank" href="https://vuejs.org"> VueJS </a>
          <a target="_blank" href="https://www.typescriptlang.org/">
            Typescript
          </a>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </section>
  <!-- ./section -->

  <!-- section -->
  <section class="row">
    <!-- col -->
    <div class="col-12">
      <div class="text-center">
        <div class="links text-xs">
          <Tooltip content="Github Repository" position="top" context="light  ">
            <a
              target="_blank"
              href="https://github.com/jason-napolitano/InertiaBB"
            >
              <FaIcon :icon="faGithub" size="sm" /> GitHub
            </a>
          </Tooltip>
          <a target="_blank" href="https://mit-license.org"> &copy; MIT </a>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </section>
  <!-- ./section -->
</template>

<script setup lang="ts">
import { faGithub } from '@fortawesome/free-brands-svg-icons'
</script>

<style scoped lang="scss">
.links > a {
  color: #636b6f;
  padding: 0 25px;
  font-weight: 600;
  letter-spacing: 0.1rem;
  text-decoration: none;
  text-transform: uppercase;
}
</style>
