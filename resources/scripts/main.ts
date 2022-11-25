/* -----------------------------------------------------------------------------
 * Application essentials
 * -------------------------------------------------------------------------- */
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'
import { resolvePageComponent } from 'vite-plugin-laravel/inertia'
import { createApp, h } from 'vue'
// import './echo'

/* -----------------------------------------------------------------------------
 * Vue Toastification
 * -------------------------------------------------------------------------- */
import Toast, { PluginOptions, POSITION } from 'vue-toastification'
import 'vue-toastification/dist/index.css'

const toastOptions: PluginOptions = {
  position: POSITION.BOTTOM_CENTER,
  timeout: 5000,
  closeButton: false,
  closeOnClick: true,
  newestOnTop: true,
  maxToasts: 1,
}

/* -----------------------------------------------------------------------------
 * Home grown components
 * -------------------------------------------------------------------------- */
import SubmitButton from '@/shared/common/buttons/submit.vue'
import Breadcrumb from '@/shared/common/breadcrumb.vue'
import Pagination from '@/shared/common/pagination.vue'
import Tooltip from '@/shared/common/tooltip.vue'

/* -----------------------------------------------------------------------------
 * Third-party components
 * -------------------------------------------------------------------------- */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { InertiaProgress } from '@inertiajs/progress'
import { QuillEditor } from '@vueup/vue-quill'
import { ElIcon } from 'element-plus'

/* -----------------------------------------------------------------------------
 * Bootstrap
 * -------------------------------------------------------------------------- */
import 'bootstrap/dist/js/bootstrap.bundle.min'

/* -----------------------------------------------------------------------------
 * Style configuration
 * -------------------------------------------------------------------------- */

// third-party
import 'bootstrap/dist/css/bootstrap.min.css'
import 'primeflex/primeflex.scss'
import 'animate.css'

// app styling
// local
import '@/styles/_breadcrumb.scss'
import '@/styles/_variables.scss'
import '@/styles/_progress.scss'
import '@/styles/_animate.scss'
import '@/styles/_colors.scss'
import '@/styles/_editor.scss'
import '@/styles/_layout.scss'
import '@/styles/_custom.scss'
import '@/styles/_alerts.scss'
import '@/styles/_fonts.scss'

// resets
import '@/styles/_resets.scss'

/* -----------------------------------------------------------------------------
 * Application configuration
 * -------------------------------------------------------------------------- */
const app = createInertiaApp({
  resolve: (name) =>
    resolvePageComponent(name, import.meta.glob('../pages/**/*.vue')),
  setup({ el, app, props }) {
    createApp({ render: () => h(app, props) })
      // components
      .component('SubmitButton', SubmitButton)
      .component('FaIcon', FontAwesomeIcon)
      .component('Breadcrumb', Breadcrumb)
      .component('Pagination', Pagination)
      .component('Tooltip', Tooltip)
      .component('Editor', QuillEditor)
      .component('ElIcon', ElIcon)
      .component('Head', Head)
      .component('Link', Link)
      // toasts -----------------------------
      .use(Toast, toastOptions)
      // Routing ----------------------------
      .mixin({
        // @ts-ignore
        methods: { route },
      })
      // mount
      .mount(el)
  },
})

/* -----------------------------------------------------------------------------
 * Progress Bar
 * NOTE: For Progress bar styling, go to resources/sass/_progress.scss
 * -------------------------------------------------------------------------- */
InertiaProgress.init({
  showSpinner: false,
  includeCSS: false,
  delay: 50, // In milliseconds
})
/* -----------------------------------------------------------------------------
 * Instantiation message
 * -------------------------------------------------------------------------- */
app.then(() => console.info('Application instantiated', '...'))
