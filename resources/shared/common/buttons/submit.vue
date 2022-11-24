<template>
  <button
    :class="`${classes ?? 'w-100 btn btn-secondary bg-gradient'} ${
      formData.processing ? 'disabled' : ''
    }`"
    :disabled="formData.processing"
    type="submit"
  >
    <span v-if="formData.processing">
      <FaIcon spin :icon="faRotateRight" size="sm" />
      <span class="ml-1">
        <slot name="processing"> Processing </slot>
      </span>
    </span>
    <span v-else>
      <slot>Submit</slot>
    </span>
  </button>
</template>

<script setup lang="ts">
// component dependencies ---------------------------------
import { faRotateRight } from '@fortawesome/free-solid-svg-icons'
import { defineComponent } from 'vue'

// component props ----------------------------------------
defineProps<{
  formData: object
  classes?: string
}>()

// component details --------------------------------------
defineComponent({
  name: 'SubmitButton',
})
</script>
