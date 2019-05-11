import Vue from 'vue'
import Vuex from 'vuex'

import App from './modules/layout'
import Messages from './modules/messages'
import Auth from './modules/auth'
import Admin from './modules/admin'
import Cache from './modules/cache'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        App,
        Messages,
        Auth,
        Admin,
        Cache
    }
})

export default store
