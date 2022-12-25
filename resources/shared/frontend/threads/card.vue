<template>
  <main class="card">
    <header class="card-header">
      <div class="flex justify-content-between align-items-center flex-row">
        <div class="flex justify-content-between">
          <span class="text-milanored">
            {{ props.thread.name }}
          </span>
        </div>
        <div class="flex justify-content-between">
          <span class="btn-group btn-group-sm">
            <!-- edit button -->
            <Link
              :href="route(props.to + '.edit', props.thread)"
              class="btn text-marina btn-sm"
            >
              <FaIcon :icon="faEdit" size="xs" /> Edit
            </Link>
            <!-- ./edit button -->

            <!-- delete button -->
            <span
              @click="softDeleteRecord(to, props.thread)"
              class="btn text-danger btn-sm"
            >
              <FaIcon :icon="faTrash" size="xs" /> Delete
            </span>
            <!-- ./delete button -->

            <!-- like button -->
            <Link
              :href="route(props.to + '.like', props.thread.uuid)"
              class="btn text-marina"
            >
              <FaIcon :icon="faThumbsUp" size="sm" class="mr-1" />
              {{ pluralize(props.likes, 'Like') }}
            </Link>
            <!-- ./like button -->
          </span>
        </div>
      </div>
    </header>
    <section
      class="card-body text-justify"
      v-html="sanitize(props.thread.content)"
    />
    <footer
      class="card-footer bg-barely-white border-tin text-right text-silver rounded-0"
    >
      <span v-if="!updatedAt(props.thread) === false">{{
          updatedAt(props.thread)
        }}</span>
      &nbsp;
      <span>
        {{ createdAt(props.thread) }} by <Username color="concrete" :user="props.thread.user" />
      </span>
    </footer>
  </main>
</template>

<script setup lang="ts">
import { softDeleteRecord, createdAt, updatedAt } from '@/utils/app'
import { faTrash, faEdit } from '@fortawesome/free-solid-svg-icons'
import { faThumbsUp } from '@fortawesome/free-regular-svg-icons'
import Username from '@/shared/common/username.vue'
import { ThreadInterface } from '@/scripts/types'
import { sanitize } from '@/utils/html'
import { plural } from '@/utils/string'

/**
 * Returns a pluralized message for the counters
 *
 * @returns {string}
 */
const pluralize = (prop: object[], value: string): string =>
  `${prop.length} ${plural(value, prop.length)}`

const props = defineProps<{
  thread: ThreadInterface
  favorites: object[]
  likes: object[],
  to: string
}>()
</script>

<style scoped lang="scss">
// ...
</style>
