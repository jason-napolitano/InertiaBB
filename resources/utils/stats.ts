// @ts-nocheck
import { usePage } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'
const page = usePage()

/**
 * @returns {number}
 */
export const users = () => computed(() => page.props.value.stats.users)
