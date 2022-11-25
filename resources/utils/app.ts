// @ts-nocheck
import { breakpointsTailwind, useBreakpoints } from '@vueuse/core'
import { TYPE, useToast } from 'vue-toastification'
import { usePage } from '@inertiajs/inertia-vue3'
import { BaseInterface, UserInterface } from '@/scripts/types'
import { Inertia } from '@inertiajs/inertia'
import { plural } from '@/utils/string'
import { computed } from 'vue'
import {formatDate} from "@/utils/date";

// scoped constants -------------------------------------

// Toast interface
const toast = useToast()
// Inertia page instance
const page = usePage()

/** --------------------------------------------
 * Does a user have permission to perform
 * a specific action?
 *
 * @param name {string} Name of the role or permission
 *
 * @returns {boolean}
 */
export const can = (name: string) => {
  // roles and permissions
  const permissions = page.props.value.user.permissions ?? []
  const roles = page.props.value.user.roles ?? []

  // empty collection for roles and permissions
  let collection: object[] = []

  // build the collection
  permissions.forEach((permission: object) => {
    collection.push(permission.name)
  })
  roles.forEach((role: object) => {
    collection.push(role.name)
  })

  // check if the value exists in the collection or check the
  // collection the wildcard value (*)
  return collection.includes(name) || collection.includes('*')
}

/** --------------------------------------------
 * Trigger the logout confirmation box
 *
 * @returns {void}
 */
export const logoutAction = () => {
  ElMessageBox({
    center: true,
    message: `
      <span class="text-lg">Are you sure you want to sign out?</span>
    `,
    dangerouslyUseHTMLString: true,
    cancelButtonText: 'Cancel',
    showConfirmButton: true,
    showCancelButton: true,
    confirmButtonText: 'Continue',
    confirmButtonClass: 'el-button--success',
    showClose: false,
    closeOnPressEscape: false,
    closeOnClickModal: false,
    type: 'info',
  })
    .then(() => {
      window.scroll(0, 0)
      return Inertia.post(route('logout'))
    })
    .catch((error) => {
      console.error('Action cancelled - Reason:', error)
    })
}

/** --------------------------------------------
 * Check if flash data exists, if so, send a
 * notification to the UI
 *
 * @returns {void}
 */
export const flashNotification = () => {
  if (page.props.value.flash.message) {
    toast(page.props.value.flash.message, {
      type: page.props.value.flash.context ?? TYPE.INFO,
    })
  }
}

/** --------------------------------------------
 * Ensures the viewport is that of a 'small'
 * device (based on Tailwind breakpoints)
 *
 * @returns {ref|boolean}
 */
export const isSmallScreen = () => {
  let breakpoints = useBreakpoints(breakpointsTailwind)
  return computed(() => breakpoints.smaller('md'))
}

/** --------------------------------------------
 * Message indicating a record cannot be deleted
 *
 * @returns {void}
 */
export const cannotPerformAction = () => {
  toast('You cannot perform this action', {
    type: TYPE.ERROR,
  })
}

/** --------------------------------------------
 * Soft-delete a record
 *
 * @param {string} to
 * @param {any}    record
 * @returns {void}
 */
export const softDeleteRecord = (to: string, record: object) => {
  ElMessageBox({
    center: true,
    message: `
      <span class="text-lg">Are you sure you want to delete this record?</span>
    `,
    dangerouslyUseHTMLString: true,
    cancelButtonText: 'Cancel',
    showConfirmButton: true,
    showCancelButton: true,
    confirmButtonText: 'Continue',
    confirmButtonClass: 'el-button--danger',
    showClose: false,
    closeOnPressEscape: false,
    closeOnClickModal: false,
    type: 'error',
  })
    .then(() => {
      Inertia.delete(window.route(`${to}.destroy`, record))
    })
    .catch((error) => {
      console.error('Action cancelled - Reason:', error)
    })
}

/** --------------------------------------------
 * Delete a record
 *
 * @param {string} to
 * @param {any}    record
 * @returns {void}
 */
export const deleteRecord = (to: string, record: object) => {
  ElMessageBox({
    center: true,
    message: `
      <span class="text-lg">This will <strong class="text-pomegranate">permanently</strong> delete the record</span>
    `,
    dangerouslyUseHTMLString: true,
    cancelButtonText: 'Cancel',
    showConfirmButton: true,
    showCancelButton: true,
    confirmButtonText: 'Continue',
    confirmButtonClass: 'el-button--danger',
    showClose: false,
    closeOnPressEscape: false,
    closeOnClickModal: false,
    type: 'error',
  })
    .then(() => {
      Inertia.delete(window.route(`${to}.delete`, record))
    })
    .catch((error) => {
      console.error('Action cancelled - Reason:', error)
    })
}

/** --------------------------------------------
 * Restore a record
 *
 * @param {string} to
 * @param {any}    record
 * @returns {void}
 */
export const restoreRecord = (to: string, record: object) => {
  const message = 'Record successfully restored'
  Inertia.post(window.route(`${to}.restore`, record))
}

/** --------------------------------------------
 * Returns the storage path for laravel's
 * file storage system
 *
 * @param value
 * @return {"/storage/"}
 */
export const storagePath = (value: string = '') => `/storage/${value}`

/** --------------------------------------------
 * Currently logged-in user
 *
 * @returns {object}
 */
export const user = computed((): UserInterface => page.props.value.user.data)

/** --------------------------------------------
 * Returns the app title
 *
 * @return {string}
 */
export const title = computed(() => page.props.value.app.title)

/** --------------------------------------------
 * Sanitize HTML for output using v-html or template
 * rendering
 *
 *
 * @param source {string}
export const sanitize = (source: string) =>
  DOMPurify.sanitize(source, { USE_PROFILES: { html: true } })
 */
