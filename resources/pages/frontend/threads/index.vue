<template layout="frontend">
  <!-- section -->
  <section class="row">
    <!-- column -->
    <div class="col-12">
      <Breadcrumb
        :items="[{ name: forum.name, route: route('forums.show', forum.uuid) }]"
      />
    </div>
    <!-- ./col -->
  </section>
  <!-- ./section -->

  <!-- section -->
  <section class="row">
    <!-- column -->
    <div class="col-12">
      <div
          class="flex justify-content-between align-items-center flex-row border-1 border-tin bg-clouds text-barely-white p-2"
      >
        <div class="flex justify-content-between">
          <span class="text-asbestos" v-text="forum.name" />
        </div>
        <div class="flex justify-content-between">
          <span class="btn-group btn-group-sm">
            <Link :href="route('threads.create')" class="btn text-asbestos">
              <FaIcon :icon="faFileEdit" size="xs" class="mr-1" /> Create
            </Link>
            <span class="btn text-asbestos">
              <FaIcon :icon="faEdit" size="xs" class="mr-1" /> Edit
            </span>
            <Link @click="softDeleteRecord('forums', forum)" class="btn text-pomegranate">
              <FaIcon :icon="faTrash" size="xs" class="mr-1" /> Delete
            </Link>
          </span>
        </div>
      </div>
      <div class="border-1 border-tin">
        <ElTable :data="props.threads.data">
          <ElTableColumn label="Thread Name">
            <template #default="scope">
              <div>
                <Link
                  class="no-underline text-guardsman"
                  :href="route('threads.show', scope.row)"
                  v-text="scope.row.name"
                />
              </div>
              <div>{{ scope.row.synopsis }}</div>
            </template>
          </ElTableColumn>
          <ElTableColumn label="Replies" width="75">
            <template #default="scope">
              {{ scope.row.posts.length ?? 0 }}
            </template>
          </ElTableColumn>
          <ElTableColumn label="Created" width="130">
            <template #default="scope">
              {{ daysAgo(scope.row.created_at) }}
            </template>
          </ElTableColumn>
          <ElTableColumn label="Last Activity" width="130">
            <template #default="scope">
              {{ daysAgo(scope.row.updated_at) }}
            </template>
          </ElTableColumn>
        </ElTable>
      </div>
    </div>
    <!-- ./column -->
  </section>
  <!-- ./section -->

  <!-- section -->
  <section class="row">
    <!-- col -->
    <div class="col-12">
      <Pagination :links="props.threads.links" />
    </div>
    <!-- ./col -->
  </section>
  <!-- ./section -->
</template>

<script setup lang="ts">
// component imports --------------------------------------
import { faTrash, faEdit, faFileEdit } from '@fortawesome/free-solid-svg-icons'
import { ForumInterface, ThreadInterface } from '@/scripts/types'
import { softDeleteRecord } from '@/utils/app'
import { daysAgo } from '@/utils/date'

// component props ----------------------------------------
const props = defineProps<{
  threads: ThreadInterface
  forum: ForumInterface
}>()
</script>

<style scoped lang="scss">
// ...
</style>
