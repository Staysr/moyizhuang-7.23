import Vue from 'vue'
import iView from 'iview'
import VueRouter from 'vue-router'
import App from './App.vue'
import store from './store'
import { router } from '../js/router/index'
import AjaxPlugin from '../js/plugins/ajax'
import CachePlugin from '../js/plugins/cache'
import VueAMap from 'vue-amap'
import moment from "moment"

Vue.use(VueRouter)
Vue.use(iView)
Vue.use(AjaxPlugin)
Vue.use(CachePlugin)
Vue.use(VueAMap)
Vue.use(moment)

moment.locale("zh-CN");

VueAMap.initAMapApiLoader({
    key: '9798eb91fcdfd5a3e7b97aff38e9a3ee',
    plugin: ['AMap.Autocomplete', 'AMap.PlaceSearch', 'AMap.Scale', 'AMap.OverView', 'AMap.ToolBar', 'AMap.MapType', 'AMap.PolyEditor', 'AMap.CircleEditor', "AMap.TruckDriving"],
    // 默认高德 sdk 版本为 1.4.4
    v: '1.4.4'
});


Vue.filter('timeformat', function (value) {
    return moment(value).format("YYYY-MM-DD dddd");
});

const app = new Vue({
    el: '#app',
    store,
    router,
    mounted() {
        this.$nextTick(function () {
            this.$store.commit('init')
        });
    },
    render: h => h(App)
});
