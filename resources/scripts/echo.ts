import Echo from 'laravel-echo'

/**
 * Returns a Laravel Echo instance
 *
 * @returns {Echo}
 */
export const echo = new Echo({
  broadcaster: 'pusher',
  key: 'my_pusher_app_key',
  wsHost: window.location.hostname,
  wsPort: 6001,
  forceTLS: false,
  disableStats: true,
})