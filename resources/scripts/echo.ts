import Echo from 'laravel-echo'

const echo = new Echo({
  broadcaster: 'pusher',
  key: 'my_pusher_app_key',
  wsHost: window.location.hostname,
  wsPort: 6001,
  forceTLS: false,
  disableStats: true,
})



echo.private(`orders.1`)
    .listen('OrderShipmentStatusUpdated', (e: any) => {
      console.info(e.order)
    });