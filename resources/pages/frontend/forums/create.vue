<template layout="backend">
  <section class="row">
    <div class="col-12">
      <Breadcrumb
        :items="[{ name: 'Create Forum', route: route('forums.create') }]"
      />
    </div>
  </section>

  <section class="row">
    <div class="col-12">
      <form
        class="card shadow-1"
        @submit.prevent="formData.post(route('forums.store'))"
      >
        <div class="card-header" v-text="`Create a new forum`" />
        <div class="card-body">
          <div class="my-2">
            <label for="name">Name</label>
            <input
              v-model="formData.name"
              type="text"
              class="form-control"
              id="name"
              name="name"
            />
            <div class="text-pomegranate">
              {{ errors.name }}
            </div>
          </div>
          <div class="my-2">
            <label for="category">Category</label>
            <select
              class="form-select rounded-0"
              v-model="formData.category_id"
              name="category_id"
              id="category"
            >
              <option
                v-for="(category, index) in props.categories"
                :key="index"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
            <div class="text-pomegranate">
              {{ errors.category_id }}
            </div>
          </div>

          <div class="my-2">
            <label for="name">Description</label>
            <textarea
              v-model="formData.content"
              type="text"
              class="form-control"
              id="name"
              name="name"
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
import { CategoryInterface, ErrorsInterface } from '@/scripts/types'
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps<{
  categories: CategoryInterface
  errors: ErrorsInterface
}>()

// form data ------------------------------------
const formData = useForm({
  category_id: null,
  content: null,
  name: null,
})
</script>

<style scoped lang="scss">
// ...
</style>
