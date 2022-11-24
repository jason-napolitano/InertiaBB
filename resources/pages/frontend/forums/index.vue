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
      <ElTable :data="props.forums.data" class="border-1 border-tin">
        <ElTableColumn label="Forum Name">
          <template #default="scope">
            <strong>
              <Link class="forum-title" :href="route('forums.show', scope.row)">
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
            {{ scope.row.threads.length ?? 0 }}
          </template>
        </ElTableColumn>
        <ElTableColumn label="Created By" width="150">
          <template #default="scope">
            <Link
              :href="route('profile.index', scope.row.user.username)"
              class="no-underline text-marina"
            >
              <code class="text-milanored w-100">@{{ scope.row.user.username }}</code>
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
import { ForumInterface } from '@/scripts/types'
import { daysAgo } from '@/utils/date'

// component props ----------------------------------------
const props = defineProps<{
  forums: ForumInterface
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
