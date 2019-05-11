<template>
  <div class="datepicker">
    <div class="date_tabs">
      <div @click="show = !show" class="date_result"> {{ dateValue }} </div>
      <img src="../../../../images/circleleft.png" class="circleleft" @click="goBackDate" alt="">
      <img src="../../../../images/circleright.png" class="circleright" @click="goToForce" v-show="isshow" alt="">
    </div>
    <div v-transfer-dom="isTransferDom">
      <popup v-model="show" :hide-on-blur="false" :popup-style="{zIndex: 504}">
        <popup-header left-text="取消" right-text="确定" @on-click-left="show = false" @on-click-right="change"></popup-header>
        <datetime-view :format="type" v-model="dateValue" @on-change="changedate"  ref="datetime"></datetime-view>
      </popup>
    </div>
    <toast 
      v-model="showPositionValue" 
      type="text" 
      :time="800" 
      is-show-mask 
      :text="toastInfo" 
      position="middle">
      </toast>
  </div>
</template>

<script>
import moment from 'moment'
import TransferDom from '../../../plugins/mobile/transfer-dom.js'
import { DatetimeView, Popup, PopupHeader, Toast  } from 'vux'

export default {
  components: {
    DatetimeView,
    Popup,
    PopupHeader,
    Toast
  },
  directives: {
    TransferDom
  },
  props: {
    isTransferDom: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
      type: '',
      value: '',
      show: false,
      isshow:false,
      showPositionValue: false,
      toastInfo: '已到今日',
      dateValue: ''
    }
  },
  created () {
      if(this.$store.state.tabsitem == 'day' ) {
          this.type = 'YYYY-MM-DD'
          this.now = moment().format('YYYY-MM-DD')
      }else { 
          this.type = 'YYYY-MM'
          this.now = moment().format('YYYY-MM')
      }
      this.dateValue = this.now
  },
  methods: {
    change(){
        this.show = false
    },
    goBackDate() {
        this.$emit('datetype', ['goback', this.dateValue])
    },
    goToForce() {
      this.$emit('datetype', ['goforce', this.dateValue])
    },
    changedate(value) {

      this.$emit('timechange', ['change',value])
      this.dateValue = value
      this.$refs.datetime.render()

    }
  },
  watch: {
    dateValue() {
      if(this.now < this.dateValue) {
        this.isshow = false
        this.dateValue = this.now
        this.showPositionValue = true
        this.show = false

      }else if ( this.now > this.dateValue ) {
        this.isshow = true
      }
    }
  },  
}
</script>

<style lang='less'>
  @import './style.less';

</style>