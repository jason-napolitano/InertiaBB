<template>
  <form @submit.prevent="formData.post(route('login.store'))">
    <div class="my-2">
      <label for="email">Email Address</label>
      <input
        v-model="formData.email"
        class="form-control"
        placeholder="Email"
        id="email"
        type="email"
      />
      <small class="text-pomegranate">
        {{ errors.email }}
      </small>
    </div>
    <div class="my-2">
      <label for="password">Password</label>
      <input
        v-model="formData.password"
        placeholder="Password"
        class="form-control"
        type="password"
        id="password"
      />
      <small class="text-pomegranate">
        {{ errors.password }}
      </small>
    </div>

    <div class="text-center my-2">
      <ElSwitch
        v-model="formData.remember"
        label="Remember Me"
        size="large"
        active-text="Remember Me"
        inactive-text="Forget Me"
      />
    </div>

    <div class="my-2">
      <SubmitButton class="bg-deepocean opacity-80" :form-data="formData">
        {{ btnText ?? 'Login' }}
      </SubmitButton>
    </div>
  </form>
</template>

<script setup lang="ts">
// component imports --------------------------------------
import { useForm } from '@inertiajs/inertia-vue3'

// form data ----------------------------------------------
const formData = useForm({
  email: '',
  password: '',
  remember: false,
})

// component props ----------------------------------------
defineProps<{
  errors: object
  btnText?: string
}>()
</script>
