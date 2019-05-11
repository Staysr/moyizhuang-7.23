import Vue from 'vue'
import Vuex from 'vuex'
import vuexI18n from 'vuex-i18n';
Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    mapinfo: [
      {name: '全部'},
      {'name': '运单中', items: ['小B业务运单中', '大B业务运单中', '空闲']},
      {name: '未出车'}
      ],
    carstate: [
      {name: '出车状态', items: ['全部','未出车','已出车']},
      {name: '空闲状态', items: ['全部','空闲','小B业务运单中','大B业务运单中']}, 
      {name: '收车原因', items: ['全部','下班','吃饭','休息会儿','请假','管理','充电','其他']}],
    delivery: [
      { name: '商户简称', items: []},
      { name: '到仓时间', items: [ '全部', '00:00-05:59', '06:00-11:59', '12:00-17:59', '18:00-23:59' ]},
      { name: '出车单状态', items: [ '全部','未签到','已签到','配送中','配送完成','设置不配送','无责任解约','运营取消'  ]},
    ],
    tabsitem: '',
    id: '',
    formresult: {
      is_work: '',
      work_status: '',
      last_end_work: '',
    },
    big_form_result: {
      date: '',
      supervisor_id: '',
      arrival_warehouse_time: [],
      status: '',
      merchant_id: ''
    },
    cycledata: {
      start_date: '',
      end_date: '' ,
      driver_id: '',
      type: 2
    },
    bigdateindex: 1,
    supervisorid: '',
    cycleleader: '',
    selone: 0,
    seltwo: 0,
    selthree: 0,
  },
  mutations: {
      changeindex(state,n) {
        state.bigdateindex = n
      },
      getsupervisor(state, n) {
        state.supervisorid = n
      },
      getcycleleader(state,n) {
        state.cycleleader = n
      },
      indexone(state, n) {
        state.selone = n
      },
      indextwo(state, n) {
        state.seltwo = n
      },
      indexthree(state, n) {
        state.selthree = n
      },
  },
  actions: {},
  modules: {
    i18n: vuexI18n.store
  }
})

Vue.use(vuexI18n.plugin, store);

export default store