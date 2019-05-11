import Vue from 'vue'
import {router} from '../js/router/index'
import store from './store'
import App from './App.vue'
import AjaxPlugin from "./plugins/ajax";
import CachePlugin from "./plugins/cache";
import mobilePlugin from './plugins/mobile'
import 'less'
import 'lib-flexible'
import VueAMap from 'vue-amap';


Vue.use(AjaxPlugin)
Vue.use(CachePlugin)
Vue.use(VueAMap)
Vue.use(mobilePlugin)


const app = new Vue({
  el: '#app',
  store,
  router,
  render: h => h(App)
});