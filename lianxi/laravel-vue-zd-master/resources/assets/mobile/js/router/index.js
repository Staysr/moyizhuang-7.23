import Vue from 'vue'
import VueRouter from 'vue-router'
import {IndexRouter} from './modules/index'
import Store from '../store/index'

Vue.use(VueRouter);

export const router = new VueRouter({
    routes: [...IndexRouter]
});


let isApp = typeof Operation !== 'undefined';

router.beforeEach((to, from, next) => {
    if (!Store.getters.isLogin && to.name !== 'common.login' && !isApp) {
        next({
            name: 'common.login'
        })
    }else if(isApp && (to.name === 'common.login' || to.name === 'common.choose')){
        next({
            name: 'home.index'
        })
    }else{
        next()
    }
});