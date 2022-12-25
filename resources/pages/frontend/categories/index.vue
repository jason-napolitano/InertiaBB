<template layout="frontend">
  <!--Head>
    <title>Forum Homepage</title>
    <meta name="description" :content="description('Forum homepage')" />
    <meta name="keywords" :content="keywords(['forum', 'homepage'])" />
  </Head-->

  <!-- section -->
  <section class="row">
    <!-- column -->
    <div class="col-12">
      <Breadcrumb />
    </div>
    <!-- ./col -->
  </section>
  <!-- ./section -->

  <!-- section -->
  <section class="row">
    <!-- column -->
    <div class="col-12" v-for="(category, index) in props.categories">
      <div
        class="flex justify-content-between align-items-center flex-row border-1 border-tin bg-clouds text-barely-white p-2"
      >
        <div class="flex justify-content-between">
          <Link
            class="text-asbestos no-underline"
            :href="route('categories.show', category.uuid)"
            v-text="category.name"
          />
        </div>
        <div class="flex justify-content-between">
          <span class="btn-group btn-group-sm">
            <Link v-if="index === 0" :href="route('categories.create')" class="btn text-asbestos">
              <FaIcon :icon="faFileEdit" size="xs" class="mr-1" /> Create
            </Link>
            <span class="btn text-asbestos">
              <FaIcon :icon="faEdit" size="xs" class="mr-1" /> Edit
            </span>
            <Link @click="softDeleteRecord('categories', category)" class="btn text-pomegranate">
              <FaIcon :icon="faTrash" size="xs" class="mr-1" /> Delete
            </Link>
          </span>
        </div>
      </div>
      <div class="border-1 border-tin">
        <ElTable :data="category.forums">
          <ElTableColumn label="Forum Name">
            <template #default="scope">
              <Link
                :href="route('forums.show', scope.row.uuid)"
                class="category-title"
              >
                {{ scope.row.name }}
              </Link>
              <div class="category-description">
                {{ scope.row.content }}
              </div>
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
</template>

<script setup lang="ts">
// component imports --------------------------------------
import { faTrash, faEdit, faFileEdit } from '@fortawesome/free-solid-svg-icons'
import { CategoryInterface } from '@/scripts/types'
import { softDeleteRecord } from '@/utils/app'
import { daysAgo } from '@/utils/date'

// component props ----------------------------------------
const props = defineProps<{
  categories: CategoryInterface[]
}>()
</script>

<style scoped lang="scss">
@import '@/styles/_colors.scss';
.category-header {
  color: $color-marina;
  text-decoration: none;
}
.category-title {
  color: $color-guardsman;
  text-decoration: none;
}

.category-description {
  text-align: justify !important;
  color: #888;
}
</style>
