<template>
  <form @submit.prevent="submitForm">
    <div class="my-1">
      <label for="title">Title</label>
      <input
        v-model="formData.name"
        type="text"
        id="title"
        class="form-control"
      />
      <div class="text-pomegranate">
        {{ errors.name }}
      </div>
    </div>

    <div class="my-2">
      <label for="content">Content</label>
      <Editor
        v-model:content="formData.content"
        content-type="html"
        :options="options"
        class="h-10rem"
        name="content"
        theme="snow"
        id="content"
      />
      <div class="text-pomegranate">
        {{ errors.content }}
      </div>
    </div>
    <div class="my-1">
      <SubmitButton :form-data="formData"> Submit Reply </SubmitButton>
    </div>
  </form>
</template>

<script setup lang="ts">
// component imports --------------------------------------
import { ErrorsInterface, ThreadInterface } from '@/scripts/types'
import { useForm } from '@inertiajs/inertia-vue3'
import { options } from '@/scripts/editor'

// form data ----------------------------------------------

const FormInterface = {
  content: '',
  name: null,
}

let formData = useForm(FormInterface)

const submitForm = () => {
  // @ts-ignore
  formData.post(route('posts.store', props.thread.uuid))
  formData = useForm(FormInterface)
}

const props = defineProps<{
  thread: ThreadInterface
  errors: ErrorsInterface
}>()
</script>

<style scoped lang="scss">
// ...
</style>
