<template>
  <!-- ./flex row -->
  <section class="flex justify-content-start flex-row flex-wrap breadcrumb">
    <!-- flex item -->
    <div class="flex align-items-center justify-content-center m-1">
      <Link class="no-underline text-guardsman mr-1" :href="route('home')">
        <FaIcon :icon="faList" size="xs" class="mr-1" /> {{ title }}
      </Link>
      <FaIcon :icon="faChevronRight" size="xs" class="bc-icon" />
    </div>
    <!-- ./flex item -->

    <!-- flex item -->
    <div
      class="flex align-items-center justify-content-center px-1"
      v-for="(item, index) in items"
    >
      <Link
        v-if="lastItemIsIndex(items, index)"
        class="no-underline text-pomegranate"
        :href="item.route"
        v-text="truncate(item.name, lastItemIsIndex(items, index) ? 25 : 0)"
      />
      <span
        v-else
        v-text="item.name"
        class="text-charcoal cursor-default opacity-90"
      />
      <FaIcon
        v-if="lastItemIsIndex(items, index)"
        :icon="faChevronRight"
        class="mx-1"
        size="xs"
      />
    </div>
    <!-- ./flex item -->
  </section>
  <!-- ./flex row -->
</template>

<script setup lang="ts">
// component imports --------------------------------------
import { faChevronRight, faList } from '@fortawesome/free-solid-svg-icons'
import { lastItemIsIndex } from '@/utils/array'
import { truncate } from '@/utils/string'
import { defineComponent } from 'vue'
import { title } from '@/utils/app'

// component props ----------------------------------------
const props = defineProps<{
  items?: object[]
}>()

// component info -----------------------------------------
defineComponent({
  name: 'breadcrumbs',
})
</script>
