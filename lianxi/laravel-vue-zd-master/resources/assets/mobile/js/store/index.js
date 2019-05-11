import Vuex from 'vuex'
import Vue from "vue"

Vue.use(Vuex);

let isApp = typeof Operation !== 'undefined';

let user = isApp ?
    JSON.parse(Operation.getUserInfo()) :
    {};

export default new Vuex.Store({
    state: {
        loading: false,
        user: user,
        auth: ''
    },
    mutations: {
        setLoading(state, data) {
            state.loading = data
        },
        setUser(state, data) {
            state.user = data
        },
        back(state) {
            Operation.operate(JSON.stringify({
                type: -1
            }))
        },
        setAuth(state, data){
            state.auth = data
        }
    },
    getters: {
        userId(state) {
            return state.user.id;
        },
        userType(state) {
            return isApp ? Number(state.user.type) : state.user.type;
        },
        isApp() {
            return isApp
        },
        headerPrefix(state) {
            return  Number(state.user.type) === 2 ? state.user.name+ '(大队长)-' : state.user.name+ '(小队长)-'
        },
        isLogin(state){
            return Boolean(state.auth)
        }
    }
});