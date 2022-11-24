<!--suppress ALL -->
<template layout="backend">
  <section class="row">
    <div class="col-12">
      <ElTable :data="users.data">
        <ElTableColumn>
          <template #header>
            <div class="">
              <ElIcon class="mt-1"><Management /></ElIcon> General Information
            </div>
          </template>
          <ElTableColumn label="Image" width="60">
            <template #default="scope">
              <img
                class="img-fluid h-3rem"
                :src="storagePath(scope.row.image)"
                alt=""
              />
            </template>
          </ElTableColumn>
          <ElTableColumn label="Name">
            <template #default="scope">
              {{ scope.row.name }}
            </template>
          </ElTableColumn>
          <ElTableColumn label="Email">
            <template #default="scope">
              <code class="w-100">{{ scope.row.email }}</code>
            </template>
          </ElTableColumn>
        </ElTableColumn>
        <ElTableColumn>
          <template #header>
            <div class="text-center">
              <ElIcon class="mt-1"><Calendar /></ElIcon> Chronology
            </div>
          </template>
          <ElTableColumn width="160">
            <template #header>
              <div class="text-center">Created</div>
            </template>
            <template #default="scope">
              <Tooltip
                :content="formatDate(scope.row.created_at)"
                placement="left"
              >
                <span class="btn text-gray-200 w-100 cursor-default">
                  {{ daysAgo(scope.row.created_at) }}
                </span>
              </Tooltip>
            </template>
          </ElTableColumn>
          <ElTableColumn width="160 ">
            <template #header>
              <div class="text-center">Updated</div>
            </template>
            <template #default="scope">
              <Tooltip
                :content="formatDate(scope.row.updated_at)"
                placement="left"
              >
                <span class="btn text-gray-200 w-100 cursor-default">
                  {{ daysAgo(scope.row.updated_at) }}
                </span>
              </Tooltip>
            </template>
          </ElTableColumn>
        </ElTableColumn>
      </ElTable>
    </div>
  </section>

  <section class="row">
    <div class="col-12">
      <Pagination :links="users.links" />
    </div>
  </section>
</template>

<script setup lang="ts">
/* ---------------------------------------------
 * Dependency imports
 * -------------------------------------------- */
import { formatDate, daysAgo } from '@/utils/date'
import { usePage } from '@inertiajs/inertia-vue3'
import { UserInterface } from '@/scripts/types'
import { Inertia } from '@inertiajs/inertia'
import { storagePath } from '@/utils/app'
import { computed } from 'vue'
import {
  CircleCloseFilled,
  RefreshRight,
  CircleClose,
  Management,
  Calendar,
  EditPen,
  Picture,
  Delete,
} from '@element-plus/icons-vue'
import {
  faPlus,
  faFileImage,
  faImages,
} from '@fortawesome/free-solid-svg-icons'

/** --------------------------------------------
 * Component props
 * ----------------------------------------- */
defineProps<{
  users: UserInterface
}>()
</script>
