<template>
    <div class="day">
        <Datepicker 
        ref="datepicker"
        @datetype="datetype"
        @timechange="timechange"
        ></Datepicker>
        <Datatotal :total="total" :type="more"></Datatotal>
        <div class="leader_list_box" v-show="showdtail">
            <Schoose :showlist="showheader"></Schoose>
            <Memberlist :list="list" :membertype="membertype" @smallid="smallid"></Memberlist>
        </div>
       </div>
    </div>
</template>

<script>
import {mapState} from 'vuex'
import moment from 'moment'
import Schoose from '../../components/tabSelect/schoose'
import Sliber from '../../components/slider_table/index'
import Datepicker from '../../components/datepicker/index.vue'
import Datatotal from '../../components/datatotal/index.vue'
import Memberlist from '../../components/memebrlist/index'

    export default {
        name: 'day',
        components: { Datepicker, Datatotal, Memberlist, mapState, Sliber, Schoose },
        computed: { ...mapState(['cycledata','supervisorid','cycleleader','getsupervisor']) },
        data () {
            return {
                date: moment().format('YYYY-MM-DD'),
                i : 1,
                a: 1,
                total: {
                    task_order_fee: 0,
                    order_complete_fee: 0,
                    number: 0,
                    order_number: 0,
                    task_order_number: 0
                },
                list: [],
                small: 'listname',
                isshow: true,
                memberlist:'',
                showheader: false,
                showdtail: true,
                driver_id: '',
                more: 0,
                membertype: '小队长'
            }
        },
        created() {
            this.cycledata.driver_id = this.$mobile.user().id
            this.cycledata.type = this.$mobile.user().type
            this.$store.state.tabsitem = "day"
            this.getdata()
        },
        methods: {
            datetype(e) {
                if( e[0] == 'goback' ) {
                    this.date = moment(e[1]).subtract(this.i, 'days').format('YYYY-MM-DD')
                    this.i++;
                    this.a = 1

                }else if ( e[0] == 'goforce' ) {
                    if( this.date < moment().subtract(1,'days').format('YYYY-MM-DD') ) {
                        this.date = moment(e[1]).subtract(this.i-1,'days').add(this.a, 'days').format('YYYY-MM-DD')
                        this.a++
                    
                    }else {
                        this.date = moment(e[1]).subtract(this.i-1,'days').add(this.a, 'days').format('YYYY-MM-DD')
                        this.i = 1
                    }
                }
            },
            getdata() {
                this.cycledata.start_date = this.date
                this.cycledata.end_date = this.date
                
                this.$http.get('statistics', {params: this.cycledata}).then((res)=> {
                    if(res.status == 200 ) {        
                        this.total = res.data.data.data
                        this.list = res.data.data.small_lists
                        this.memberlist = res.data.data.small_lists
                    }
                })
            },
            chooseitem(e) {
               
            },
            timechange(e) {
                if(e[0] == 'change') {
                    this.i = 1;
                    this.a = 1;
                    this.datetype(e[0])
                    this.date = e[1]
                }
            },
            smallid(e) {
                
            }
        },
        watch: {
            date() {
                this.$refs.datepicker.dateValue = this.date
                this.getdata()
            },
          
        }
    }
</script>

<style lang="less">
.day {
    /*position: absolute;*/
    /*top: 186px;
    left: 0;
    bottom: 0;
    right: 0;
    background: #eee;*/

    .leader_list_box {
        margin-top: 20px;
    }
} 

</style>