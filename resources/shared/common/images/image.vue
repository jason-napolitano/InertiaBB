<template>
  <ElImage :src="src" :class="classes" :alt="alt" :fit="fill" :lazy="lazy">
    <template #placeholder>
      <slot name="placeholder">
        <div class="image-slot" v-if="placeholder">
          <ElIcon>
            <Loading />
          </ElIcon>
        </div>
      </slot>
    </template>
    <template #error>
      <slot name="error">
        <div class="image-slot">
          <ElIcon>
            <Picture />
          </ElIcon>
        </div>
      </slot>
    </template>
  </ElImage>
</template>

<script setup lang="ts">
/* ---------------------------------------------
 * Dependency imports
 * -------------------------------------------- */
import { Picture, Loading } from '@element-plus/icons-vue'
import { defineComponent } from 'vue'

/* ---------------------------------------------
 * Component data
 * -------------------------------------------- */
defineComponent({
  name: 'Image',
})

/* ---------------------------------------------
 * Component props
 * -------------------------------------------- */
defineProps({
  placeholder: {
    type: Boolean,
    required: false,
    default: true,
  },
  fill: {
    type: String,
    required: false,
    default: 'cover',
    validator: (value: string) =>
      ['fill', 'contain', 'cover', 'none', 'scale-down'].includes(value),
  },
  alt: {
    type: String,
    required: false,
    default: '',
  },
  src: {
    type: String,
    required: false,
    default: '',
  },
  classes: {
    type: String,
    required: false,
    default: '',
  },
  lazy: {
    type: Boolean,
    required: false,
    default: true,
  },
})
</script>

<style scoped lang="scss">
.el-image {
  width: 100%;
  min-height: 200px;
}
.image-slot {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  background: var(--el-fill-color-light);
  color: var(--el-text-color-secondary);
  font-size: 2rem;
}
.image-slot .el-icon {
  font-size: 30px;
}
</style>
