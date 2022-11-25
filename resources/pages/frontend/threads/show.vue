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

                <!-- edit button -->
                <Tooltip content="Edit">
                  <Link
                    :href="route('threads.edit', thread)"
                    class="btn text-marina btn-sm"
                  >
                    <FaIcon :icon="faEdit" size="xs" /> Edit
                  </Link>
                </Tooltip>
                <!-- ./edit button -->

                <!-- delete button -->
                <Tooltip content="Delete">
                  <span
                    @click="softDeleteRecord('threads', thread)"
                    class="btn text-danger btn-sm"
                  >
                    <FaIcon :icon="faTrash" size="xs" /> Delete
                  </span>
                </Tooltip>
                <!-- ./delete button -->

                <!-- reply button -->
                <Tooltip content="Replies">
                  <a href="#posts" class="btn">
                    <FaIcon :icon="faCommentDots" size="sm" class="mr-1" />
                    {{ repliesText(props.posts) }}
                  </a>
                </Tooltip>
                <!-- ./reply button -->

                <!-- subscribe button -->
                <Tooltip content="Posts">
                  <Link
                    :href="route('threads.favorite', thread.uuid)"
                    class="btn"
                  >
                    <FaIcon :icon="subIcon" size="sm" class="mr-1" />
                    {{ favoritesText(props.favorites) }}
                  </Link>
                </Tooltip>
                <!-- ./subscribe button -->

                <!-- like button -->
                <Tooltip content="Like">
                  <Link
                    :href="route('threads.like', thread.uuid)"
                    class="btn text-marina"
                  >
                    <FaIcon :icon="faThumbsUp" size="sm" class="mr-1" />
                    {{ likesText(props.likes) }}
                  </Link>
                </Tooltip>
                <!-- ./like button -->

              </span>
            </div>
          </div>
        </section>
        <div class="card-body" v-html="cleanMessage(thread.content)" />
        <!-- isEdited message -->
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
import { storagePath, softDeleteRecord } from '@/utils/app'
import Image from '@/shared/common/images/image.vue'
import DOMPurify from 'isomorphic-dompurify'
import { formatDate } from '@/utils/date'
import { computed } from 'vue'
import {
  ThreadInterface,
  PostInterface,
  UserInterface,
  ForumInterface,
  BaseInterface,
} from '@/scripts/types'
import { faThumbsUp } from '@fortawesome/free-regular-svg-icons'
import {
  faFaceGrinStars as subIcon,
  faCommentDots,
  faShare,
  faTrash,
  faEdit,
  faFlag,
} from '@fortawesome/free-solid-svg-icons'
import { plural } from '@/utils/string'

// computed properties ------------------------------------
const name = computed(() => 'Awesome Member')

/**
 * Returns a message for the `likes` counter
 *
 * @param {object[]} value
 *
 * @returns {string}
 */
const likesText = (value: object[] | []): string =>
  `${value.length} ${plural('Like', value.length)}`

/**
 * Returns a message for the `replies` counter
 *
 * @param {object[]} value
 *
 * @returns {string}
 */
const favoritesText = (value: object[] | []): string =>
  `${value.length} ${plural('Subscriber', value.length)}`

/**
 * Returns a message for the `replies` counter
 *
 * @param {object[]} value
 *
 * @returns {string}
 */
const repliesText = (value: object[]): string =>
  `${value.length} ${plural('Reply', value.length)}`

/**
 * Has a record been edited since its creation?
 * If so, display the correct message or false.
 *
 * @param {BaseInterface} record
 *
 * @returns {string|boolean}
 */
const isEditedMessage = (record: BaseInterface): string | boolean =>
  record.updated_at !== record.created_at
    ? `Last modified on ${formatDate(record.updated_at)}`
    : false

/**
 * Sanitize an HTML string for v-html
 *
 * @param {string} string
 *
 * @returns {string}
 */
const cleanMessage = (string: string): string =>
    DOMPurify.sanitize(string, { USE_PROFILES: { html: true } })

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
