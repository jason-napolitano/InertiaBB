<template>
  <nav
    class="navbar navbar-expand-sm bg-deepocean opacity-90 navbar-dark"
  >
    <div class="container">
      <Link class="navbar-brand" :href="route('home')">
        <slot name="brand">
          <FaIcon :icon="faListDots" size="xs" class="mr-1" />
          {{ title }}
        </slot>
      </Link>
      <button
        aria-label="Toggle navigation"
        data-bs-toggle="collapse"
        data-bs-target="#navbar"
        aria-controls="navbar"
        class="navbar-toggler"
        aria-expanded="false"
        type="button"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <div class="navbar-nav ms-auto">
          <!-- div class="navbar-item">
            <Link
              :href="route('profile.index', user.username)"
              class="nav-link"
            >
              <img
                class="w-1rem h-1rem rounded-circle mr-1 mb-1"
                :src="storagePath(user.image ?? 'no-avatar.jpg')"
                :alt="user.name"
              />
              {{ user.name }}
            </Link>
          </div>

          <div class="navbar-item" v-if="user !== null && can('manage_users')">
            <Link :href="route('users.index')" class="nav-link"> Users </Link>
          </div -->

          <div class="navbar-item">
            <div class="nav-link">
              <!-- FaIcon
                  @click="logoutAction"
                  :icon="faSignOut"
                  size="xs"
                  class="cursor-pointer"
                / -->
              <span @click="logoutAction" class="cursor-pointer">Logout</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup lang="ts">
// component imports
import { logoutAction, user, can, storagePath, title } from '@/utils/app'
import { faListDots } from '@fortawesome/free-solid-svg-icons'
import { defineComponent } from 'vue'

// component data
defineComponent({
  name: 'Navbar',
})
</script>
