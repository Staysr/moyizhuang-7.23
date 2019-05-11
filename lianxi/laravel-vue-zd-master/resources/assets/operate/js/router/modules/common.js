export const common = [
  {
    path: '/',
    name: 'index',
    meta: {title: '司机概论'},
    component: resolve => {
      require(['../../views/home.vue'], resolve)
    }
  },
  {
    path: 'login',
    name: 'login',
    meta: {title: '登录'},
    component: resolve => {
      require(['../../views/login.vue'], resolve)
    }
  },
  {
    path: '/membermap',
    name: 'membermap',
    meta: {title: '队员概览'},
    component: resolve => {
      require(['../../views/membermap/index.vue'], resolve)
    }
  },
  {
    path: '/profile',
    name: 'memberprofile',
    meta: {title: '测试(小队长)-队员概况'},
    component: resolve => {
      require(['../../views/memberProfile/index.vue'], resolve)
    }
  },
  {
    path: '/cycledata',
    name: 'cycledata',
    meta: {title: '测试(小队长)-队员概况'},
    component: resolve => {
      require(['../../views/cycledata/index.vue'], resolve)
    }
  },
  {
    path: '/cycledatadetail',
    name: 'cycledatadetail',
    meta: {title: '测试(小队长)-队员概况'},
    component: resolve => {
      require(['../../views/cycledata/detail.vue'], resolve)
    }
  },
  {
    path: '/deliverdetail',
    name: 'deliverdetail',
    meta: {title: '出车单详情'},
    component: resolve => {
      require(['../../views/deliverdetail/index.vue'], resolve)
    }
  },
  {
    path: '/memberdetail',
    name: 'memberdetail',
    meta: {title: '出车单详情'},
    component: resolve => {
      require(['../../views/memberdetail/index.vue'], resolve)
    }
  },
  {
    path: '/search',
    name: 'search',
    meta: {title: '测试(小队长)-队员概况'},
    component: resolve => {
      require(['../../views/search/index.vue'], resolve)
    }
  }
];