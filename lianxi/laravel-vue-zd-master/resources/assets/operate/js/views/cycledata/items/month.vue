<template>
    <div class="month">
        <Datepicker
            ref="datepicker"
            v-on:date="date"
            @datetype="datetype"
            @timechange="timechange"
        ></Datepicker>
        <Datatotal :total="total" :type="more"></Datatotal>
         <div class="leader_list_box" v-show="showdtail">
            <Schoose :showlist="showheader"></Schoose>
            <Memberlist :list="memberlist" :membertype="membertype" ></Memberlist>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
import {mapState} from 'vuex'
import Datepicker from '../../components/datepicker/index.vue'
import Datatotal from '../../components/datatotal/index.vue'
import Sliber from '../../components/slider_table/index'
import Memberlist from '../../components/memebrlist/index'
import Schoose from '../../components/tabSelect/schoose'

    export default {
        name: 'month',
        components: { Datepicker, Datatotal, Sliber, Memberlist, Schoose },
        created() {
            this.$store.state.tabsitem = "month"
            this.date = moment().format('YYYY-MM')
        },
        data() {
            return {
                date: 'YYYY-MM',
                i : 1,
                a: 1,
                total: [],
                list: [],
                small: 'listname',
                showdtail: true,
                showheader: false,
                memberlist:'',
                more: 1,
                membertype: '小队长' 
            }
        },
        methods: {
            datetype(e) {
                if( e[0] == 'goback' ) {
                    
                    this.isshow = true
                    this.date = moment(e[1]).subtract(this.i, 'month').format('YYYY-MM')
                    this.i++;

                }else if ( e[0] == 'goforce' ) {

                    if( this.date < moment().subtract(1,'month').format('YYYY-MM') ) {
                        this.date = moment(e[1]).subtract(this.i-1,'month').add(this.a, 'month').format('YYYY-MM')
                        this.a++
                    
                    }else {
                        this.date = moment(e[1]).subtract(this.i-1,'month').add(this.a, 'month').format('YYYY-MM')
                        this.isshow = false
                        this.i = 1
                        this.a = 1
                    }
                }
            },
            getdata(start, end) {
                this.cycledata.start_date = start
                this.cycledata.end_date = end

                this.$http.get('statistics', {params: this.cycledata}).then((res)=> {
                    
                    if(res.status == 200 ) {            
                        this.total = res.data.data.data
                        this.list = res.data.data.small_lists
                        this.isshow = true
                        this.memberlist = res.data.data.small_lists
                    }
                })
            },
            timechange(e) {
                if(e[0] == 'change') {
                    this.i = 1;
                    this.a = 1;
                    this.datetype(e[0])
                    this.date = e[1]
                }
            }
        },
        watch: {
            date() {
                this.$refs.datepicker.dateValue = this.date
                this.getdata(this.start,this.end)
            },
            
        },
        computed: {
            ...mapState(['cycledata']),
            start(date) {
                let start = moment(this.date).startOf('month')._d
                return moment(start).format('YYYY-MM-DD')
            },
            end(date) {
                let end = moment(this.date).endOf('month')._d
                return moment(end).format('YYYY-MM-DD')
            }
        }
    }
</script>

<style lang="less">
.month {
    .outermost-layer {
        top: 1030px;
    }
    .leader_list_box {
        margin-top: 20px;
    }
}

</style>