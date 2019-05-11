import CachePlugins from '../cache'

const mobile = {
    is() {
        return typeof Operation !== 'undefined'
    },
    login() {
        return typeof Operation !== 'undefined' || CachePlugins.$cache.get('token')
    },
    user() {
        return typeof Operation === 'undefined' ? CachePlugins.$cache.get('userInfo') : (Operation.getUserInfo());
    },
    operate(json){
        Operation.operate(JSON.stringify(json))
    },
    name() {
        return typeof Operation !== 'undefined' || CachePlugins.$cache.get('capname'); 
    }
}


export default {
    install(Vue) {
        Vue.prototype.$mobile = mobile
        Vue.mobile = mobile
    },
    $mobile: mobile
}

export const $mobile = mobile