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
      <ElTable :data="props.threads.data" class="border-1 border-tin">
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
        <ElTableColumn label="Created By" width="150">
          <template #default="scope">
            <Link
              :href="route('profile.index', scope.row.user.username)"
              class="no-underline"
            >
              <code class="text-milanored">@{{ scope.row.user.username }}</code>
            </Link>
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
import { faPlus as addThreadIcon } from '@fortawesome/free-solid-svg-icons'
import { ForumInterface, ThreadInterface } from '@/scripts/types'
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
