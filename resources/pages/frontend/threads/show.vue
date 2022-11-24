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
    <div class="col-2">
      <div class="card">
        <div class="card-body p-0">
          <div class="card-header p-0 border-bottom-0">
            <Link
              :href="route('profile.index', props.user.username)"
              class="btn btn-secondary w-100 rounded-0"
              v-text="props.user.username"
            />
          </div>
          <Image :src="storagePath('no-avatar.jpg')" class="card-image" />
        </div>
        <div
          class="card-footer"
          v-text="formatDate(props.thread.created_at, 'MM-DD-YYYY hh:mm A')"
        />
      </div>
    </div>
    <!-- ./column -->

    <!-- column -->
    <div class="col-10">
      <div class="card">
        <section class="card-header">
          <div class="flex justify-content-between align-items-center flex-row">
            <div class="flex justify-content-between">
              <span class="text-milanored">
                {{ thread.name }}
              </span>
            </div>
            <div class="flex justify-content-between">
              <span class="btn-group btn-group-sm">
                <Tooltip content="Edit">
                  <Link
                    :href="route('threads.edit', thread)"
                    class="btn text-marina btn-sm"
                  >
                    <FaIcon :icon="faEdit" size="xs" /> Edit
                  </Link>
                </Tooltip>

                <Tooltip content="Delete">
                  <span
                    @click="softDeleteRecord('threads', thread)"
                    class="btn text-danger btn-sm"
                  >
                    <FaIcon :icon="faTrash" size="xs" /> Delete
                  </span>
                </Tooltip>

                <Tooltip content="Posts">
                  <a href="#posts" class="btn">
                    <FaIcon :icon="faCommentDots" size="sm" class="mr-1" />
                    {{ repliesText(props.posts) }}
                  </a>
                </Tooltip>

                <Tooltip content="Posts">
                  <Link :href="route('threads.favorite', thread.uuid)" class="btn">
                    <FaIcon :icon="faStar" size="sm" class="mr-1" />
                    {{ favoritesText(props.favorites) }}
                  </Link>
                </Tooltip>

                <Tooltip content="Like">
                  <Link
                    :href="route('threads.like', thread.uuid)"
                    class="btn text-marina"
                  >
                    <FaIcon :icon="faThumbsUp" size="sm" class="mr-1" />
                    {{ likesText(props.likes) }}
                  </Link>
                </Tooltip>
              </span>
            </div>
          </div>
        </section>
        <div class="card-body">
          {{ thread.content }}
        </div>
        <div
          v-if="!isEditedMessage(thread) === false"
          v-text="isEditedMessage(thread)"
          class="card-footer text-right text-asbestos rounded-0"
        />
      </div>
    </div>
    <!-- ./column -->
  </section>

  <!-- section -->
  <section v-if="posts.length > 0" class="row" v-for="post in posts" id="posts">
    <!-- column -->
    <div class="col-2">
      <div class="card mb-3">
        <div class="card-header">November 08, 2022</div>
        <div class="card-body p-0">
          <Image
            :src="storagePath('placeholder-thumb.png')"
            class="card-image"
          />
          <div class="text-center">
            <span class="btn btn-secondary w-100 rounded-0 rounded-bottom">
              {{ name }}
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- ./column -->

    <!-- column -->
    <div class="col-10">
      <div class="card">
        <div class="card-header">
          {{ post.name }}
        </div>
        <div class="card-body">
          {{ post.content }}

          <div>
            <hr />
          </div>

          <div class="text-right">
            <div class="btn-group">
              <span class="btn btn-sm btn-primary">
                <Tooltip position="left" content="Share">
                  <FaIcon :icon="faShare" class="mr-1" />
                </Tooltip>
              </span>
              <span class="btn btn-sm btn-secondary">
                <Tooltip position="left" content="Reply">
                  <FaIcon :icon="faCommentDots" class="mr-1" />
                </Tooltip>
              </span>
              <span class="btn btn-sm btn-danger">
                <Tooltip position="left" content="Report">
                  <FaIcon :icon="faFlag" class="mr-1" />
                </Tooltip>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ./column -->
  </section>

  <!-- section -->
  <section class="row">
    <!-- column -->
    <div class="col-2"></div>
    <!-- ./column -->

    <!-- column -->
    <div class="col-10">
      <hr />
    </div>
    <!-- ./column -->
  </section>

  <!-- section -->
  <section class="row">
    <!-- column -->
    <div class="col-2"></div>
    <!-- ./column -->

    <!-- column -->
    <div class="col-10">
      <div class="card">
        <div class="card-header">
          <FaIcon :icon="faCommentDots" size="xs" />
          {{ posts.length < 1 ? 'Be the first to reply' : 'Submit Reply' }}
        </div>
        <div class="card-body">
          <div>
            <PostReplyForm />
          </div>
        </div>
      </div>
    </div>
    <!-- ./column -->
  </section>
</template>

<script setup lang="ts">
// component imports --------------------------------------
import PostReplyForm from '@/shared/frontend/replies/form.vue'
import Image from '@/shared/common/images/image.vue'
import { formatDate } from '@/utils/date'
import { computed } from 'vue'
import {
  likesText,
  repliesText,
  isEditedMessage,
  storagePath,
  softDeleteRecord,
  favoritesText,
} from '@/utils/app'
import {
  ThreadInterface,
  PostInterface,
  UserInterface,
  ForumInterface,
} from '@/scripts/types'
import { faThumbsUp } from '@fortawesome/free-regular-svg-icons'
import {
  faCommentDots,
  faStar,
  faShare,
  faTrash,
  faEdit,
  faFlag,
} from '@fortawesome/free-solid-svg-icons'

// computed properties ------------------------------------
const name = computed(() => 'Awesome Member')

// component properties -----------------------------------
const props = defineProps<{
  thread: ThreadInterface
  posts: PostInterface
  forum: ForumInterface
  user: UserInterface
  favorites: object[]
  likes: object[]
}>()
</script>

<style scoped lang="scss">
.card-image {
  width: 100%;
  height: 6rem;
  display: block;
}
</style>
