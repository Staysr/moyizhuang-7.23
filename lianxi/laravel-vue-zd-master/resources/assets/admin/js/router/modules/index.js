export const IndexRouter = [
    {
        path: 'home',
        name: 'common.home',
        meta: {title: '首页'},
        component: resolve => {
            require(['../../views/common/home.vue'], resolve)
        }
    },
    {
        path: 'profile',
        name: 'common.profile',
        meta: {title: '个人中心'},
        component: resolve => {
            require(['../../views/common/profile.vue'], resolve)
        }
    },
    {
        path: 'sysconfig.permission',
        name: 'sysconfig.permission.index',
        meta: {title: '权限&菜单'},
        component: resolve => {
            require(['../../views/sysconfig/permission/index.vue'], resolve)
        }
    },
    {
        path: 'sysconfig.role',
        name: 'sysconfig.role.index',
        meta: {title: '角色管理'},
        component: resolve => {
            require(['../../views/sysconfig/role/index.vue'], resolve)
        }
    },
    {
        path: 'sysconfig.admin',
        name: 'sysconfig.admin.index',
        meta: {title: '用户管理'},
        component: resolve => {
            require(['../../views/sysconfig/admin/index.vue'], resolve)
        }
    },
    {
        path: 'sysconfig.config',
        name: 'sysconfig.config.index',
        meta: {title: '系统配置'},
        component: resolve => {
            require(['../../views/sysconfig/config/index.vue'], resolve)
        }
    },
    {
        path: 'sysconfig.safe',
        name: 'sysconfig.safe.index',
        meta: {title: '保险设置'},
        component: resolve => {
            require(['../../views/sysconfig/safe/index.vue'], resolve)
        }
    },
    {
        path: 'base.driver.index',
        name: 'base.driver.index',
        meta: {title: '自营司机'},
        component: resolve => {
            require(['../../views/base/driver/index.vue'], resolve)
        }
    },
    {
        path: 'base.driver.work',
        name: 'base.driver.work',
        meta: {title: '合作司机'},
        component: resolve => {
            require(['../../views/base/driver/work.vue'], resolve)
        }
    },
    {
        path: 'base.driver.social',
        name: 'base.driver.social',
        meta: {title: '社会司机'},
        component: resolve => {
            require(['../../views/base/driver/social.vue'], resolve)
        }
    },
    {
        path: 'base.merchant.index',
        name: 'base.merchant.index',
        meta: {title: '商户信息'},
        component: resolve => {
            require(['../../views/base/merchant/index.vue'], resolve)
        }
    },
    {
        path: 'task.create/:id?',
        name: 'task.create',
        meta: {title: '招司机'},
        component: resolve => {
            require(['../../views/task/create.vue'], resolve)
        }
    },
    {
        path: 'base.car.index',
        name: 'base.car.index',
        meta: {title: '车辆管理'},
        component: resolve => {
            require(['../../views/base/car/index.vue'], resolve)
        }
    },
    {
        path: 'warehouse.index',
        name: 'warehouse.index',
        meta: {title: '仓库管理'},
        component: resolve => {
            require(['../../views/warehouse/index.vue'], resolve)
        }
    },
    {
        path: 'time.index',
        name: 'time.index',
        meta: {title: '配送点管理'},
        component: resolve => {
            require(['../../views/time/index.vue'], resolve)
        }
    },
    {
        path: 'point.index',
        name: 'point.index',
        meta: {title: '配送点查看'},
        component: resolve => {
            require(['../../views/time/point.vue'], resolve)
        }
    },
    {
        path: 'task.order',
        name: 'task.order',
        meta: {title: '出车单管理'},
        component: resolve => {
            require(['../../views/taskOrder/index.vue'], resolve)
        }
    },
    {
        path: 'task.lists',
        name: 'task.lists',
        meta: {title: '线路任务管理'},
        component: resolve => {
            require(['../../views/task/index.vue'], resolve)
        }
    },
    {
        path: 'bill.month',
        name: 'bill.month',
        meta: {title: '商户已出账单'},
        component: resolve => {
            require(['../../views/finance/bill/month.vue'], resolve)
        }
    },
    {
        path: 'bill.day',
        name: 'bill.day',
        meta: {title: '商户未出账单'},
        component: resolve => {
            require(['../../views/finance/bill/day.vue'], resolve)
        }
    },
    {
        path: 'account.driver',
        name: 'account.driver',
        meta: {title: '司机账户'},
        component: resolve => {
            require(['../../views/finance/driver/index.vue'], resolve)
        }
    },
    {
        path: 'account.merchant',
        name: 'account.merchant',
        meta: {title: '商户账户'},
        component: resolve => {
            require(['../../views/finance/merchant/index.vue'], resolve)
        }
    },
    {
        path: 'award.index',
        name: 'award.index',
        meta: {title: '司机奖惩'},
        component: resolve => {
            require(['../../views/finance/award/index.vue'], resolve)
        }
    }
]
