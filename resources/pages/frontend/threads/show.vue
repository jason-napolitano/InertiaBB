<template layout="frontend">
  <!-- section -->
  <section class="row">
    <!-- column -->
    <div class="col-12">
      <Breadcrumb
        :items="[
          {
            name: props.forum.name,
            route: route('forums.show', props.forum.uuid),
          },
          { name: props.thread.name },
        ]"
      />
    </div>
    <!-- ./row -->
  </section>
  <!-- ./section -->

  <!-- section -->
  <section class="row">
    <!-- column -->
    <div class="col-12">
      <PostCard :likes="likes" :favorites="favorites" :thread="props.thread" to="threads" class="shadow-1" />
    </div>
    <!-- ./column -->
  </section>
  <!-- ./section -->

  <!-- section -->
  <section v-if="posts.length > 0" class="row" v-for="post in posts" id="posts">

    <!-- column -->
    <div class="col-12">
      <PostCard :likes="post.likes" :favorites="post.favorites" :thread="post" to="posts" />
    </div>
    <!-- ./column -->
  </section>
  <!-- ./section -->

  <!-- section -->
  <section class="row" id="comment-form">
    <!-- column -->
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <FaIcon :icon="faCommentDots" size="xs" />
          {{ posts.length < 1 ? 'Be the first to reply' : 'Submit Reply' }}
        </div>
        <div class="card-body">
          <div>
            <PostReplyForm :errors="errors" :thread="thread" />
          </div>
        </div>
      </div>
    </div>
    <!-- ./column -->
  </section>
  <!-- ./section -->
</template>

<script setup lang="ts">
// component imports --------------------------------------
import { faCommentDots } from '@fortawesome/free-regular-svg-icons'
import PostReplyForm from '@/shared/frontend/replies/form.vue'
import PostCard from '@/shared/frontend/threads/card.vue'
import {
  ThreadInterface,
  PostInterface,
  UserInterface,
  ForumInterface,
} from '@/scripts/types'


// component properties -----------------------------------
const props = defineProps<{
  thread: ThreadInterface
  forum: ForumInterface
  posts: PostInterface
  user: UserInterface
  favorites: object[]
  likes: object[]
  errors: object
}>()
</script>

<style scoped lang="scss">
.card-image {
  width: 100%;
  height: 6rem;
  display: block;
}
</style>
