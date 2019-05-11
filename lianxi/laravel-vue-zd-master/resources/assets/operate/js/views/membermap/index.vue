<template>
    <div> 
        <div id="layoutmap">
            <Moreheader :title="title" :backpath="backpath"  :detailpath="detailpath"></Moreheader>
                <div class="main">
                    <div style="background: #fff" class="memmemtotal" ref="infoBox">
                        <div class="memnum">
                            <p class="num_title">队员数</p>
                            <p class="num_num teamnum">{{total}}</p>
                        </div>
                        <div class="memnum">
                            <p class="num_title">今日小B业务<br>接单数</p>
                            <p class="num_num">{{smallorder}}</p>
                        </div>
                        <div class="memnum">
                            <p class="num_title">今日大B业务<br>接单数</p>
                            <p class="num_num">{{bigorder}}</p>
                        </div>
                    </div>
                    
                    <div class="map_select">
                        <div v-for="(item, index) in selitem" v-bind:class="{selectItem, selected_map_item: index == selindex} " @click="selectItem(index, item)">
                            {{item}}
                        </div>
                        <div class="map_select_result" ref="mapResult" v-show="showresult">
                            <div class="select-box">
                                 <!--select_item_active-->
                                <p v-bind:class="['map_select_result_item', resultindex == 0 ? 'select_item_active' : '' ]" @click="chooseSelect(0)">
                                    <label for="orange" class="orange"></label>
                                    <span class="result_item_name">小B业务运单中({{small.length}})</span>
                                </p>
                                <p v-bind:class="['map_select_result_item', resultindex == 1 ? 'select_item_active' : '' ]" @click="chooseSelect(1)">
                                    <label for="violet" class="violet"></label>
                                    <span class="result_item_name">大B业务运单中({{ big.length}})</span>
                                </p>
                                <p v-bind:class="['map_select_result_item', resultindex == 2 ? 'select_item_active' : '' ]" @click="chooseSelect(2)">
                                    <label for="green" class="green"></label>
                                    <span class="result_item_name">空闲({{empty.length}})</span>
                                </p>
                            </div>
                        </div>
                    </div>
                   <!--map-->
                <div class="map">
                    <Mapinfo :mapdata="choosearray" :getview="getview" @update='refresh' ref="mapinfo"></Mapinfo>
                </div>  

            </div>
        </div>       
        
    </div>
</template>

<script>
import Mapinfo from '../components/map/index'
import SelectsItem from '../components/tabSelect/selects-item'
import Moreheader from '../components/header/more'


        export default {
            components: { SelectsItem , Moreheader, Mapinfo},
            data () {
                return {
                    carstate: '',
                    mapdata: [],
                    getview: false,
                    backpath: "",
                    selindex: 0,
                    choosearray: [],
                    is: '',
                    resultindex: '',
                    showresult:'',
            };
        },
        computed: {
            title() {
                return this.$cache.get('userInfo').name + '-队员概览'

            },
            total() {
                return this.mapdata.length
            },
            bigorder() {
                let num = 0;
                this.mapdata.forEach((e)=> {
                    num+=e.task_orders_count
                })
                return num 
            },
            smallorder() {
                let num = 0;
                this.mapdata.forEach((e)=> {
                    num+=e.orders_count
                })
                return num 
            },
            noWork(){
                return this.mapdata.filter((res) => res.is_work === 0 && res.is_big_work === 0).length
            },
            noWorklist() {
                return this.mapdata.filter((res) => res.is_work === 0 && res.is_big_work === 0)
            },
            hadOrderlist() {
                return this.mapdata.filter((res) => res.is_work === 1 && res.is_big_work === 0)
            },
            hasOrder() {
                return  this.small.length+ this.big.length + this.empty.length
            },
            emptylist() {
                return this.mapdata.filter((res) => res.work_status == 0 && res.is_work == 1 && res.is_big_work == 0)
            },
            small() {
                return this.hadOrderlist.filter((res) => res.is_work === 1 && res.is_big_work === 0 &&res.work_status == 1 )
            },
            big() {
                return this.hadOrderlist.filter((res) => res.is_big_work === 1)
            },
            empty() {
                return this.hadOrderlist.filter((res) => res.work_status == 0 && res.is_work == 1 && res.is_big_work == 0)
            },
            selitem(){
                return [
                    `全部(${this.total})`,
                    `运单中(${this.hasOrder})`,
                    `未出车(${this.noWork})`,
                ];
            },
        },
        methods: {
            renovate() {
                let id = this.$mobile.user().id;
                
                this.$http.get('map', { params: {driver_id : id}}).then((res)=> {
                    if(res.status == 200) {
                        this.mapdata = res.data.data
                        this.choosearray = this.mapdata
                    }
                })
            },
       
          tabsClick(){
                this.sum=[];
                if(this.activeName === 'first'){
                    this.markers = this.list;
                    this.showresult = false
                   
                }else if(this.activeName === 'second'){
                    this.markers = this.hasOrder;
                    
                }else{
                    this.markers = this.noneOrder;
                    this.showresult = false
                } 
            },
            loadAll() {
                return this.sum;
            },
            selectItem(index, item) {
                this.selindex = index
                let map = []
                if(this.selindex == 2) {
                    this.showresult = false
                    this.choosearray = this.noWorklist
                }else if (index == 1) {
                    this.showresult = true
                    // this.choosearray = this.hadOrderlist
                }else if (this.selindex == 0) {
                    this.showresult = false
                    this.choosearray = this.mapdata
                }
            },
            chooseSelect(e) {
                this.resultindex = e
                if(this.resultindex == 0) {
                    this.choosearray = this.small
                }else if (this.resultindex == 1) {
                    this.choosearray = this.big
                }else if (this.resultindex == 2) {
                    this.choosearray = this.emptylist
                }
                // this.resultindex = undefined
                this.showresult = false
            },
            searchMapinfo() {
                this.isshow = true
            },
            refresh(e) {
                 this.selindex = 0
                this.renovate()
            }
        },
        created () {
            this.detailpath = '/profile'
            if(this.$mobile.is()){
                this.$mobile.operate({type: -1})
            }else{
                this.backpath = '/'
            }
            this.carstate = this.$store.state.mapinfo
        },
        mounted() {
            this.renovate()
            this.searchInfo = this.loadAll();
        },
    }
    </script>

<style lang='less'>
    .map_select {
        width: 100%;
        z-index: 35;
        position: realtive;
        top: 200px;
        height: 88px;
        .selectItem {
            width: 33.3333%;
            line-height: 88px;
            background: #fff;
            float: left;
            color: #333;
            font-size: 32px;
            text-align: center;
            position: relative;
            margin-top: 10px;
            
            &:last-of-type {
                &::after {
                    content: '';
                    height: 25px;
                    width: 25px;
                    background: #BEBEBE;
                    position: absolute;
                    left: 35px;
                    top: 50%;
                    transform: translateY(-50%);
                }
            }
        }
        .map_select_result {
            width: 100%;
            position: absolute;
            top: 338px;
            z-index: 30;
            background: #fff;
            .select-box {
                padding: 0 30px;
                 .map_select_result_item {
                    position: relative;
                    width: 100%;
                    padding-left: 68px;
                    line-height: 87px;
                    font-size: 30px;
                    color: #666;
                    box-sizing: border-box;
                    border-bottom: 1px solid #EFEFEF;
                   
                    &:last-of-type { 
                        border-bottom: transparent;
                    }
                   
                    .orange {
                        width: 25px;
                        height: 25px;
                        position:absolute;
                        background: #F87702;
                        top: 31px;
                        left: 10px;
                        
                        
                    }
                    .violet {
                        width: 25px;
                        height: 25px;
                        position:absolute;
                        background: #C300D5;
                        top:31px;
                        left: 10px;
                    }
                    .green {
                        width: 25px;
                        height: 25px;
                        position:absolute;
                        background: #0ACA61;
                        top:31px;
                        left: 10px;
                    }
                }
            }
        }
    }
    .select_item_active {
        &::before {
            content: "";
            height: 16px;
            width: 3px;
            background: #07CA61;
            display: inline-block;
            transform: rotate(-45deg);
            position:absolute;
            right: 40px;
            top: 45%;
        }
        &::after {
            content: "";
            height: 30px;
            width: 3px;
            background: #07CA61;
            display: inline-block;
            transform: rotate(45deg);
            position:absolute;
            right: 24px;
            top: 32%;
        }
    }
    
     
    .amap-logo,.amap-copyright{
        height: 0;
        width: 0;
    } 
    #layoutmap  {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        background: #EEE;
        overflow: hidden;
        font-size: 0;
    }
    nav {
        width: 100%;
        position: relative;
        text-align: center;
        border-bottom: 1px solid #eae6e6;
        background: #fff;
    }
    nav .leftarrow {
        position: absolute;
        width: 30px;
        height: 40px;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
    }
    nav span {
        display: inline-block;
        font-size: 36px;
        color: #333;
        line-height: 88px;
    }
    nav .more {
        height: 40px;
        width: 40px;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }
        .layout .datail {
        border-bottom: 1px solid #eae6e6;
        background: #fff;
    }
    ul {
        padding: 10px 0;
        width: 100%;
        text-align: center;
        box-sizing: border-box;
        
    }
    li:first-of-type {
        border-right: 1px solid #eae6e6;
    }
    
    li p:first-of-type {
        color: #999;
        font-size: 26px;
        margin-bottom: 5px;
    }
    li p:last-child {
        font-size: 46px;
        color: #333;
    }
   
    .memmemtotal {
        width: 100%;
        background: #fff;
        z-index: 30;
        text-align: center;
        .memnum {
            background: #fff;
            float: left;
            height: 150px;
            width: 33.1%;
           
            &:nth-child(2) {
                border-left: 1px solid #D9D9D9;
                border-right: 1px solid #D9D9D9;
            }

            .num_title {
                font-size: 26px;
                color: #999;
                line-height: 28px;
                margin-top: 20px;
            }
            .num_num {
                font-size: 46px;
                color: #333;
            }
            .teamnum {
                margin-top: 30px;
                
            }
        }
    }
    
    #sel .layout {
        top: 20px;
    
        .selResult {
            top: 240px;
        }    
    }

    .map {
        width: 100%;
        position: absolute;
        bottom: 0;
        top: 338px;
    }
    .map img {
        height: 68px;
        width: 68px;
        position: absolute;
        right: 10px;
        z-index: 30;
    }
    .map .map_search {
        bottom: 100px;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }
    .map img:nth-child(2) {
        bottom: 20px;
    }
    .map .position {
        height: 68px;
        width: 68px;
        position: absolute;
        left: 10px;
        z-index: 30;
        bottom: 20px;
    }
    .markers {
        height: 1000px;
        width: 1000px;
        display: inline-block;
    }
    .coverinfo {
        width: 100%;
        /*height: 402px;*/
        height: auto;
        background: #fff;
        position: fixed;
        bottom: -13px;
        z-index: 999;
    }
    .coverinfo .line {
        padding: 0 20px;
        height: 99px;
        border-bottom: 1px solid #e9e9e9;
        font-size: 28px;
    }
    .coverinfo .line:last-child {
        border-bottom: none;
    }
    .coverinfo .line span {
        display: inline-block;
        color: #999;
        vertical-align:middle;   
        text-align: left;
        width: 50%;
        padding-top: 30px;
        padding-bottom: 20px;
        box-sizing: border-box;
    }
    .coverinfo .line .right {
        float: right;
        color: #333;
        width: 50%;
        text-align: right;
        word-break: none;
        word-wrap: none;
    }
    .coverinfo img {
        height: 68px;
        width: 68px;
        position: absolute;
        right: 10px;
    }
    .coverinfo .search {
        top: -176px;
        overflow: hidden;
    }
    .coverinfo img:nth-child(2) {
        top: -95px;
    }
    .coverinfo .position {
        height: 68px;
        width: 68px;
        position: absolute;
        left: 10px;
        z-index: 999;
        top: -95px;
    }
    #cancle {
        font-size: 28px;
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
    }
    .el-dialog__wrapper {
        overflow: hidden!important;
        background: #fff;
    }
    .el-dialog__body {
        padding: 0px!important;
    }
    .mint-my-searchbar-core,.mint-my-cell-empty {
        font-size: 30px;
    }
    .mint-my-searchbar-core {
        background: #fff;
    }
    .mint-my-cell-title {
        font-size: 30px;
        padding-left: 20px;
    }
    .selected_map_item {
        color: #07CA61!important;
        position: relative;
        &::after {
            width: 114px;
            height: 5px;
            background: #07CA61;
            content: '';
            position: absolute;
            bottom: 2px;
            left: 28%;
        }
    }
    </style>