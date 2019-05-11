import Vue from 'vue'
import VueRouter from 'vue-router'
import {common} from './modules/common'
import MobilePlugins from '../plugins/mobile'

Vue.use(VueRouter);

export const router = new VueRouter({
  routes: [...common]
})

router.beforeEach((to, from, next) => {
  if (!MobilePlugins.$mobile.login() && to.name !== 'login') {
    next({
      name: 'login'
    });
  }else if(MobilePlugins.$mobile.is() && to.name === 'index'){
      next({
          name: 'membermap'
      });
  }
  next()
});