<template layout="backend">
  <section class="row">
    <div class="col-12">
      <ElTable :data="dataProp.data">
        <ElTableColumn>
          <template #header>
            <div class="">
              <ElIcon class="mt-1"><Management /></ElIcon> General Information
            </div>
          </template>
          <ElTableColumn width="60" class="">
            <template #header>
              <div class="text-center">
                <strong class="text-pomegranate"> ID </strong>
              </div>
            </template>
            <template #default="scope">
              <div class="text-pomegranate opacity-80 w-100 h-100">
                {{ scope.row.id }}
              </div>
            </template>
          </ElTableColumn>
          <ElTableColumn label="Name">
            <template #default="scope">
              {{ scope.row.name }}
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
    <div class="col">
      <Pagination :links="dataProp.links" />
    </div>
  </section>
</template>

<script setup lang="ts">
/* ---------------------------------------------
 * Dependency imports
 * -------------------------------------------- */
import { Management, Calendar } from '@element-plus/icons-vue'
import Pagination from '@/shared/common/pagination.vue'
import { ElTable, ElTableColumn } from 'element-plus'
import { formatDate, daysAgo } from '@/utils/date'
import { UserInterface } from '@/scripts/types'

/** --------------------------------------------
 * Component props
 * ----------------------------------------- */
defineProps<{
  dataProp: UserInterface
}>()
</script>

<style scoped lang="scss">
// ...
</style>
