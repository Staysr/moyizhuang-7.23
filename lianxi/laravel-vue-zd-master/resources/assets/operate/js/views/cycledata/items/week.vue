<template>
    <div class="week">
        <!--日期选择-->
        <div class="week_picker">
            <div class="week_tabs">
                <span class="week_start">{{ start }}</span>
                至
                <span class="week_end">{{ end }}</span>
            </div>
            <img src="../../../../images/circleleft.png" class="picker_left" v-show="!show" alt="" @click="goback">
            <img src="../../../../images/circleright.png" v-show="showforce" class="picker_right" alt="" @click="goforce">
        </div>
        <Datatotal :total="total" :type="more"></Datatotal>
        <div class="leader_list_box" v-show="showdtail">
            <Schoose :showlist="showheader"></Schoose>
            <Memberlist :list="memberlist" :membertype='membertype'></Memberlist>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
import {mapState} from 'vuex'
import Datatotal from '../../components/datatotal/index.vue'
import Sliber from '../../components/slider_table/index'
import Schoose from '../../components/tabSelect/schoose'
import Memberlist from '../../components/memebrlist/index'

    export default {
        name: 'week',
        components: { Datatotal,Sliber, Schoose, Memberlist },
        computed: { ...mapState(['cycledata','tabsitem']) },
        data () {
            return {
                i: 0,
                a: 7,
                show: false,
                end: '',
                start: '',
                list: [],
                total: [],
                small: 'listname',
                more: 1,
                memberlist: [],
                showdtail: true,
                showheader: false,
                membertype: '小队长',
                showforce: false
            }
        },
        created () {
            let weekday = moment().format('E')
            let today, end; 
            if( weekday > 1 ) {
                today = moment().subtract( weekday - 1 - this.i, 'days' ).format('YYYY-MM-DD')
                end = moment().subtract(weekday - 7 , 'days').format('YYYY-MM-DD')
            }else {
                today = moment().subtract(this.i, 'days').format('YYYY-MM-DD')
                end = moment().subtract(moment().format('E')-this.a, 'days').format('YYYY-MM-DD')
                
            }
            
            this.start = today
            this.end = end
        },
        methods: {
            goback() {
                this.isshow = !this.show
                this.i += 7
                this.a -= 7
                this.weekcount(this.i , this.a)
                this.showforce = true
            },
            goforce() {
                let end = moment().subtract(moment().format('E')-7, 'days').format('YYYY-MM-DD')
                if( end  === this.end ) {
                    this.showforce = false
                }else {
                    this.i -= 7
                    this.a += 7
                    this.weekcount(this.i , this.a)
                }
            },
            weekcount( i, a) {

                this.start = moment().subtract(  moment().format('E') - 1 + i, 'days' ).format('YYYY-MM-DD')
                this.end = moment().subtract(moment().format('E') - a, 'days').format('YYYY-MM-DD')

            },
            getdata() {
                this.cycledata.start_date = this.start
                this.cycledata.end_date = this.end

                this.$http.get('statistics', {params: this.cycledata}).then((res)=> {
                    if(res.status == 200 ) {            
                        this.total = res.data.data.data
                        this.list = res.data.data.small_lists
                        this.memberlist = res.data.data.small_lists
                        if(this.list.length == 0) {
                            this.isshow = false
                        }else {
                            this.isshow = true
                        }
                    }
                })
            }
        },
        watch: {
            start() {
                this.getdata()
            },
        }
    }
</script>

<style lang="less">
    .week {
        .leader_list_box {
            margin-top: 20px;
        }
        .week_picker {
            width: 100%;
            height: 79px;
            line-height: 80px;
            position: relative;

            top: 98px;
            .picker_left, .picker_right {
                height: 44px;
                width: 44px;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                z-index: 30;
            }
            .picker_left {
                left: 20px;
            }
            .picker_right {
                right: 20px;
            }
            .week_tabs {
                font-size: 34px;
                color: #333;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                left: 25%;
            }
        }
        .bg {
            margin-top: 98px;
        }
        .outermost-layer {
            top: 920px;
        }
    }
</style>