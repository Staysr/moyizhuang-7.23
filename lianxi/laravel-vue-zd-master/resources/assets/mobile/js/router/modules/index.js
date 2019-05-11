export const IndexRouter = [{
    path: '/common.login',
    name: 'common.login',
    meta: {title: '登录'},
    component: resolve => {
        require(['../../views/common/login.vue'], resolve)
    }
}, {
    path: '/common.choose',
    name: 'common.choose',
    meta: {title: '选取大队长'},
    component: resolve => {
        require(['../../views/common/choose.vue'], resolve)
    }
}, {
    path: '/',
    name: 'home.index',
    meta: {title: '第一个页面', keepAlive: false},
    component: resolve => {
        require(['../../views/home/index.vue'], resolve)
    }
}, {
    path: '/driver.index',
    name: 'driver.index',
    meta: {title: '第一个页面的子页面'},
    component: resolve => {
        require(['../../views/driver/index.vue'], resolve)
    }
}, {
    path: '/profile.index',
    name: 'profile.index',
    meta: {title: '第二个页面'},
    component: resolve => {
        require(['../../views/profile/index.vue'], resolve)
    }
}, {
    path: '/profile.big-show',
    name: 'profile.big-show',
    meta: {title: '第二个页面-子页面'},
    component: resolve => {
        require(['../../views/profile/components/big-show.vue'], resolve)
    }
}, {
    path: '/statistics',
    name: 'statistics.index',
    meta: {title: '第三个页面'},
    component: resolve => {
        require(['../../views/statistics/index.vue'], resolve)
    }
}, {
    path: '/statistics.show',
    name: 'statistics.show',
    meta: {title: '第三个子页面'},
    component: resolve => {
        require(['../../views/statistics/show.vue'], resolve)
    }
}];