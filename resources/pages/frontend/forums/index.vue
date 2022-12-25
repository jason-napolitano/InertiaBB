<template layout="frontend">
  <!-- section -->
  <section class="row">
    <!-- column -->
    <div class="col-12">
      <Breadcrumb :items="[{ name: 'Home', route: route('home') }]" />
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
          <span class="text-asbestos" v-text="props.category.name" />
        </div>
        <div class="flex justify-content-between">
          <span class="btn-group btn-group-sm">
            <Link :href="route('forums.create')" class="btn text-asbestos">
              <FaIcon :icon="faFileEdit" size="xs" class="mr-1" /> Create
            </Link>
            <span class="btn text-asbestos">
              <FaIcon :icon="faEdit" size="xs" class="mr-1" /> Edit
            </span>
            <Link @click="softDeleteRecord('categories', props.category)" class="btn text-pomegranate">
              <FaIcon :icon="faTrash" size="xs" class="mr-1" /> Delete
            </Link>
          </span>
        </div>
      </div>
      <div class="border-1 border-tin">
        <ElTable :data="props.forums.data">
          <ElTableColumn label="Forum Name">
            <template #default="scope">
              <strong>
                <Link
                  class="forum-title"
                  :href="route('forums.show', scope.row)"
                >
                  {{ scope.row.name }}
                </Link>
                <div class="forum-description">
                  {{ scope.row.content }}
                </div>
              </strong>
            </template>
          </ElTableColumn>
          <ElTableColumn label="Threads" width="75">
            <template #default="scope">
              {{ scope.row.forums.length ?? 0 }}
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
  </section>
  <!-- ./section -->

  <!-- section -->
  <section class="row">
    <!-- col -->
    <div class="col-12">
      <Pagination :links="props.forums.links" />
    </div>
    <!-- ./col -->
  </section>
  <!-- ./section -->
</template>

<script setup lang="ts">
// component imports --------------------------------------
import { faTrash, faEdit, faFileEdit } from '@fortawesome/free-solid-svg-icons'
import { CategoryInterface, ForumInterface } from '@/scripts/types'
import { softDeleteRecord } from '@/utils/app'
import { daysAgo } from '@/utils/date'

// component props ----------------------------------------
const props = defineProps<{
  forums: ForumInterface
  category: CategoryInterface
}>()
</script>

<style scoped lang="scss">
@import '@/styles/_colors.scss';
.forum-title {
  color: $color-guardsman;
  text-decoration: none;
}

.forum-description {
  text-align: justify !important;
  color: #888;
}
</style>
