import Echo from 'laravel-echo'
import Pusher from 'pusher-js'
// @ts-ignore
window.Pusher = Pusher
Pusher.logToConsole = true

/**
 * Returns a Laravel Echo instance
 *
 * @returns {Echo}
 */
const echo = new Echo({
  broadcaster: 'pusher',
  key: 'kEWstKTl535RxYDajOHq57Rk72v',
  wsHost: window.location.hostname,
  wsPort: 6001,
  forceTLS: false,
  disableStats: true,
})

export default echo
