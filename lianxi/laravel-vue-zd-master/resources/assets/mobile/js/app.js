import Vue from 'vue'
import "@babel/polyfill"
import store from './store'
import {router} from './router/index'
import App from './layout/App.vue'
import AjaxPlugin from "./plugins/ajax"
import CachePlugin from "./plugins/cache"
import Toast from './components/toast/index'
import 'lib-flexible'
import './plugins/compatible/index'


Vue.use(AjaxPlugin);
Vue.use(CachePlugin);
Vue.use(Toast);


new Vue({
    el: '#app',
    store,
    router,
    render: h => h(App)
});