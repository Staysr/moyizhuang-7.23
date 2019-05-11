import axios from 'axios'
import wxCache from '../cache/index'
import {router} from "@/admin/js/router";
import iView from 'iview';
import fs from 'file-saver'


iView.LoadingBar.config({
    color: '#5cb85c',
    failedColor: '#f0ad4e'
});

const instance = axios.create({
    baseURL: '/api/',
    timeout: 20000
});

// 添加请求拦截器
instance.interceptors.request.use((config) => {
    iView.LoadingBar.start();
    // 在发送请求之前做些什么
    let $token = wxCache.$cache.get('token');
    config.headers = {
        'Accept': 'application/json'
    }
    if ($token) {
        config.headers['authorization'] = 'bearer ' + $token;
    }
    return config;
}, (error) => {
    iView.LoadingBar.error();
    // 对请求错误做些什么
    return Promise.reject(error);
});

// 添加响应拦截器
instance.interceptors.response.use((response) => {
    iView.LoadingBar.finish();
    // 对响应数据做点什么
    return response;
}, (error) => {
    iView.LoadingBar.error();
    // 对响应错误做点什么
    if (error.response && error.response.status === 401 && error.response.data.message === 'Unauthenticated.') {
        router.app.$cache.clear()
        router.app.$router.push({
            name: 'common.login'
        })
        window.location.reload();
    } else {
        return Promise.reject(error);
    }
});

instance.download = (url, data = {}, filename = '导出.xlsx') => {
    instance.get(url, {
        params: data,
        responseType: 'blob'
    }).then(response => {
        fs.saveAs(response.data, filename);
    }).catch(err => {
        iView.Message.error(`导出失败`);
    })
}

export default {
    install(Vue) {
        Vue.prototype.$http = instance
        Vue.http = instance
    },
    $http: instance
}

export const $http = instance