<template>
    <div :class="['detail',showtype == 0 ? 'moredata' : 'onedata' ]">
        <header class="searchback" @click="gobackdate">
           <div class="leftarrow"></div>
           <div class="title">{{cycleleader.name}}-队员详情</div>
        </header>
        <Datatotal :total="total" :type="showtype"></Datatotal>
        <Schoose :showlist="showheader"></Schoose>
        <Sliber id="big_table" :type="small" :list="list"></Sliber>
        <div class="tools">
            <span class="search" @click="goToSearch">
                <img src="../../../images/search.png" alt="">
            </span>
            <span class="goTop" @click="goTop">
                <img src="../../../images/goTop.png" alt="">
            </span>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex'
import moment from 'moment'
import Schoose from '../components/tabSelect/schoose'
import Sliber from '../components/slider_table/index'
import Datatotal from '../components/datatotal/index.vue'

    export default {
        name: 'detail',
        components: {  Datatotal, mapState, Sliber, Schoose },
        computed: { 
            ...mapState(['cycledata','supervisorid','cycleleader']),
            showtype() {
                return this.$route.query.type == 0 ? 0 : 1
            }
        },
        data () {
            return {
                date: moment().format('YYYY-MM-DD'),
                i : 1,
                a: 1,
                total: [],
                list: [],
                small: 'listname',
                isshow: true,
                memberlist:'',
                showheader: false,
                showdtail: true,
                type: 'leaderdetail',
            }
        },
        created() {
            if( this.$route.query.leaderid != '') {
                this.cycledata.driver_id = this.$route.query.leaderid
            }
            this.getdata()
        },
        methods: {
            getdata() {
                this.$http.get('statistics', {params: this.cycledata}).then((res)=> {
                    if(res.status == 200 ) {            
                        this.total = res.data.data.data
                        this.list = res.data.data.lists
                        this.memberlist = this.list
                    }
                })
            },
            gobackdate() {
                this.$router.push('/cycledata?id=' + this.$route.query.id)
            },
            goToSearch() {
                this.$router.push('/search?type=listname'+'&&id='+ this.$route.query.id)
            },
            goTop() {
                if(document.documentElement.scrollTop != 0) {
                    setTimeout(()=> {
                        document.documentElement.scrollTop = 0
                    }, 300)
                }
            },
        },
    }
</script>

<style lang="less">
.detail {
    width: 100%;
    height: auto;
    
    

    .schoose {
        top: 20px;
    }
    .leader_list_box {
        margin-top: 20px;
    }
    .searchback {
        width: 100%;
        text-align: center;
        .title {
            line-height: 90px;
            font-size: 36px;
            color: #333;
            position: relative;
            
        }
        .leftarrow {
            display: inline-block;
            content: " ";
            height: 25px;
            width: 25px;
            border-width: 4px 4px 0 0;
            border-color: #c7c7cc;
            border-style: solid;
            transform: rotate(222deg);
            position: absolute;
            left: 30px;
            top: 30px;
        }
    }
    .tools {
        height: 158px;
        width: 58px;
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 35;
        background: transparent!important;
    }
    .search img, .goTop img {
        height: 68px;
        width: 68px;
        background: transparent!important;
    }
    .search  {
        position: absolute;
        top: 0;
        background: transparent!important;
    }
    .goTop {
        position: absolute;
        bottom: 0;
        z-index: 40;
    }
} 
.moredata {
    .outermost-layer {
        top: 996px;
    }
}

.onedata {
    .outermost-layer {
        top: 846px;
    }
}

</style>