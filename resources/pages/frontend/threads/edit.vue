<template layout="backend">
  <section class="row">
    <div class="col-12">
      <Breadcrumb
        :items="[
          { name: thread.name, route: route('threads.show', thread) },
          { name: 'Edit Form' },
        ]"
      />
    </div>
  </section>

  <section class="row">
    <div class="col-12">
      <form
        class="card"
        @submit.prevent="formData.put(route('threads.update', thread))"
      >
        <div class="card-header" v-text="thread.name" />
        <div class="card-body">
          <div class="my-2">
            <label for="name">Name</label>
            <input
              class="form-control rounded-0"
              :placeholder="thread.name"
              v-model="formData.name"
              type="text"
              name="name"
              id="name"
            />
            <div class="text-pomegranate">
              {{ errors.name }}
            </div>
          </div>
          <div class="my-2">
            <label for="forum">Forum</label>
            <select
              class="form-select rounded-0"
              v-model="formData.forum_id"
              name="forum_id"
              id="forum"
            >
              <option
                v-for="(forum, index) in forums"
                :value="forum.id"
                :key="index"
              >
                {{ forum.name }}
              </option>
            </select>
            <div class="text-pomegranate">
              {{ errors.forum_id }}
            </div>
          </div>

          <div class="my-12">
            <label for="synopsis">Synopsis</label>
            <textarea
              v-model="formData.synopsis"
              class="form-control"
              name="synopsis"
              id="synopsis"
            ></textarea>
            <div class="text-pomegranate">
              {{ errors.synopsis }}
            </div>
          </div>

          <div class="my-2">
            <label for="content">Content</label>
            <Editor
              :content="formData.content"
              content-type="html"
              :options="options"
              class="h-25rem"
              name="content"
              theme="snow"
              id="content"
            />
            <div class="text-pomegranate">
              {{ errors.content }}
            </div>
          </div>
        </div>

        <div class="card-footer">
          <SubmitButton
            classes="w-100 btn bg-gradient btn-primary"
            :form-data="formData"
          />
        </div>
      </form>
    </div>
  </section>
</template>

<script setup lang="ts">
// component dependencies -----------------------
import { useForm } from '@inertiajs/inertia-vue3'
import { options } from '@/scripts/editor'
import {
  ErrorsInterface,
  ThreadInterface,
  ForumInterface,
} from '@/scripts/types'

// component props ------------------------------
const props = defineProps<{
  errors: ErrorsInterface
  thread: ThreadInterface
  forums: ForumInterface
}>()

// form data ------------------------------------
const formData = useForm({
  name: null,
  content: null,
  synopsis: null,
  forum_id: null,
})
</script>

<style scoped lang="scss">
// ...
</style>
