// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import axios from 'axios'
import iziToast from 'iziToast'
import Modal from './components/backend/partials/Modal'

Vue.config.productionTip = false

Vue.prototype.$axios = axios;
Vue.prototype.$iziToast = iziToast;
Vue.component("modal", Modal);

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
