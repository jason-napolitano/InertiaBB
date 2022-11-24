<template>
  <form @submit.prevent="formData.post(route('register.store'))">
    <!-- input -->
    <div class="my-2">
      <label for="name">Full Name</label>
      <input
        v-model="formData.name"
        placeholder="Full Name"
        is="name"
        type="text"
        class="w-100 form-control"
      />
      <div class="text-pomegranate">
        {{ errors.name }}
      </div>
    </div>

    <!-- input -->
    <div class="my-2">
      <label for="username">Username</label>
      <input
        v-model="formData.username"
        placeholder="Username"
        id="username"
        type="text"
        class="w-100 form-control"
      />
      <div class="text-pomegranate">
        {{ errors.username }}
      </div>
    </div>

    <!-- input -->
    <div class="my-2">
      <label for="email">Email Address</label>
      <input
        v-model="formData.email"
        placeholder="Email Address"
        id="email"
        type="text"
        class="w-100 form-control"
      />
      <div class="text-pomegranate">
        {{ errors.email }}
      </div>
    </div>

    <!-- input -->
    <div class="my-2">
      <label for="image">Profile Picture</label>
      <input type="file" id="image" class="w-100 form-control" />
      <div class="text-pomegranate">
        {{ errors.image }}
      </div>
    </div>

    <!-- input -->
    <div class="my-2">
      <label for="password">Password</label>
      <input
        v-model="formData.password"
        placeholder="Enter Password"
        id="password"
        type="password"
        class="w-100 form-control"
      />
      <div class="text-pomegranate">
        {{ errors.password }}
      </div>
    </div>

    <!-- input -->
    <div class="my-2">
      <label for="password_confirm">Confirm Password</label>
      <input
        v-model="formData.password_confirmation"
        placeholder="Repeat Password"
        id="password_confirm"
        type="password"
        class="w-100 form-control"
      />
      <div class="text-pomegranate">
        {{ errors.password_confirmation }}
      </div>
    </div>

    <!-- submit -->
    <div class="my-2">
      <SubmitButton class="bg-deepocean opacity-80" :form-data="formData" />
    </div>
  </form>
</template>

<script setup lang="ts">
/* ---------------------------------------------
 * Dependency imports
 * -------------------------------------------- */
import { useForm } from '@inertiajs/inertia-vue3'

/* ---------------------------------------------
 * Form data
 * -------------------------------------------- */
const formData = useForm({
  username: '',
  image: '',
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

/* ---------------------------------------------
 * Component props
 * -------------------------------------------- */
defineProps<{
  errors: object
}>()
</script>
