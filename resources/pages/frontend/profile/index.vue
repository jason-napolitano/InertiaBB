<template layout="frontend">
  <section class="row">
    <div class="col-12">
      <h1 class="text-dark">
        <img
          class="profile-img"
          :src="storagePath(user.image)"
          :alt="user.name"
        />
        <span>{{ props.profile.name }}</span>
        <sup class="lead text-milanored font-bold opacity-70">
          @<code class="text-milanored">{{ props.profile.username }}</code>
        </sup>
      </h1>
    </div>
  </section>

  <section class="row">
    <div class="col-md-6 col-sm-12">
      <ul class="list-group">
        <li class="list-group-item list-group-item-secondary">Last 5 forums</li>
        <li
          class="list-group-item"
          v-for="forum in props.forums"
          v-if="props.forums.length > 1"
        >
          &rarr;
          <Link
            class="no-underline text-milanored ml-1"
            :href="route('forums.show', forum.uuid)"
            v-text="forum.name"
          />
        </li>

        <li class="list-group-item" v-else>There are no items to display</li>
      </ul>
    </div>

    <div class="col-md-6 col-sm-12">
      <ul class="list-group">
        <li class="list-group-item list-group-item-secondary">
          Last 5 threads
        </li>
        <li
          class="list-group-item"
          v-for="thread in props.threads"
          v-if="props.threads.length > 1"
        >
          &rarr;
          <Link
            class="no-underline text-milanored ml-1"
            :href="route('threads.show', thread.uuid)"
            v-text="thread.name"
          />
        </li>

        <li class="list-group-item" v-else>There are no items to display</li>
      </ul>
    </div>
  </section>
</template>

<script setup lang="ts">
// component props ------------------------------
import { storagePath, user } from '@/utils/app'
import {
  ForumInterface,
  PostInterface,
  ThreadInterface,
  UserInterface,
} from '@/scripts/types'

const props = defineProps<{
  threads: ThreadInterface
  forums: ForumInterface
  profile: UserInterface
  posts: PostInterface
}>()
</script>

<style scoped lang="scss">
$size: 1.75rem;
.profile-img {
  border-radius: 50% !important;
  margin-bottom: 0.35rem !important;
  margin-right: 0.25rem !important;
  height: $size !important;
  width: $size !important;
}
.divider {
  border-top: 1px solid #e5e5e5 !important;
}
</style>
