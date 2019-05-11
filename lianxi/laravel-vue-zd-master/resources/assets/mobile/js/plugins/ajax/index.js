import axios from 'axios'
import {router} from "../../router";
import Store from '../../store/index'


const instance = axios.create({
    baseURL: '/operate/',
    timeout: 10000
});

// 添加请求拦截器
instance.interceptors.request.use((config) => {
    // 在发送请求之前做些什么
    let $token = Store.state.auth;
    config.headers = {
        'Accept': 'application/json'
    }
    if ($token) {
        config.headers['authorization'] = 'bearer ' + $token;
    }
    return config;
}, (error) => {
    // 对请求错误做些什么
    return Promise.reject(error);
});

// 添加响应拦截器
instance.interceptors.response.use((response) => {
    // 对响应数据做点什么
    return response;
}, (error) => {
    // 对响应错误做点什么
    if (error.response && error.response.status === 401 && error.response.data.message === 'Unauthenticated.') {
        router.app.$cache.clear()
        router.app.$router.push({
            name: 'common.login'
        })
    } else {
        return Promise.reject(error);
    }
});


export default {
    install(Vue) {
        Vue.prototype.$http = instance
        Vue.http = instance
    },
    $http: instance
}

export const $http = instance