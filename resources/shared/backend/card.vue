<template>
  <div :class="`card-box bg-${context}`">
    <div class="inner">
      <h3>{{ count }}</h3>
      {{ text }}
    </div>
    <div class="icon">
      <icon :icon="icon" aria-hidden="true" />
    </div>
    <div v-if="showFooter" class="">
      <Link :href="to" class="card-box-footer pr-2" v-if="footer">
        <span class="mr-1">View All</span> <icon :icon="footerIcon" />
      </Link>
      <div class="card-box-footer h-2rem" v-else></div>
    </div>
  </div>
</template>

<script setup>
/* ---------------------------------------------
 * Dependency imports
 * -------------------------------------------- */
import {
  faArrowCircleRight as footerIcon,
  faChartLine as mainIcon,
} from '@fortawesome/free-solid-svg-icons'
/* ---------------------------------------------
 * Component props
 * -------------------------------------------- */
defineProps({
  footer: {
    type: Boolean,
    default: true,
  },
  to: {
    type: String,
    default: 'dashboard',
    required: false,
  },
  context: {
    type: String,
    default: 'marina',
    required: false,
  },
  text: {
    type: String,
    default: 'Active Users',
    required: false,
  },
  icon: {
    default: mainIcon,
    required: false,
  },
  count: {
    type: Number,
    default: 0,
    required: false,
  },
  showFooter: {
    type: Boolean,
    default: true,
    required: false,
  },
})
</script>

<style scoped>
.card-box {
  position: relative;
  color: #fff;
  padding: 20px 10px 40px;
  margin: 20px 0;
}
.card-box:hover {
  text-decoration: none;
  color: #f1f1f1;
}
.card-box:hover .icon i {
  font-size: 100px;
  transition: 1s;
  -webkit-transition: 1s;
}
.card-box .inner {
  padding: 5px 10px 0 10px;
}
.card-box h3 {
  font-size: 27px;
  font-weight: bold;
  margin: 0 0 8px 0;
  white-space: nowrap;
  padding: 0;
  text-align: left;
}
.card-box p {
  font-size: 15px;
}
.card-box .icon {
  position: absolute;
  top: auto;
  bottom: 5px;
  right: 5px;
  z-index: 0;
  font-size: 92px;
  color: rgba(0, 0, 0, 0.15);
}
.card-box .card-box-footer {
  position: absolute;
  left: 0;
  bottom: 0;
  text-align: right;
  padding: 0.25rem;
  color: rgba(255, 255, 255, 0.8);
  background: rgba(0, 0, 0, 0.1);
  width: 100%;
  text-decoration: none;
}
.card-box:hover .card-box-footer {
  background: rgba(0, 0, 0, 0.3);
}
.bg-blue {
  background-color: #00c0ef !important;
}
.bg-green {
  background-color: #00a65a !important;
}
.bg-orange {
  background-color: #f39c12 !important;
}
.bg-red {
  background-color: #d9534f !important;
}
</style>
