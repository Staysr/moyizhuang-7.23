<template>
    <div class="search">
        <Back :title="title" :path="path"></Back>
        <search
            v-model="value"
            position="absolute"
            auto-scroll-to-top
            @on-focus="onFocus"
            @on-cancel="onCancel"
            @on-submit="onSubmit"
            top="0"
            ref="search">
        </search>
        <div class="empty" v-show="!isshow">
            <img src="../../../images/search_icon.png" alt="">
        </div>
        <div class="result_list" v-show="isshow">
            <ul class="search_list_result">
                <li v-for="item in result" @click='getItem(item)' v-if="item.name == undefined">{{item.driver.name}}</li>
                <li v-for="item in result" @click='getItem(item)' v-if="item.name != undefined">{{item.name}}</li>
            </ul>
        </div>
        <Slider :list="list" :type="type" :showleader='showleader' v-show="list.length > 0"></Slider>
    </div>
</template>

<script>
import { Search } from 'vux'
import { mapState } from 'vuex'
import moment from 'moment'
import Slider from '../components/slider_table/index'
import Back from '../components/header/back'

    export default {
        name: 'searchInput',
        components: { Search, Slider, Back },
        data () {   
            return {
                results: [],    
                value: '',
                isshow: false,
                form: {
                    last_end_work: '',
                    is_work: '',
                    work_status: '',
                    supervisor_id: '',
                    id: ''
                },
                list: [],
                type: '',
                path: '',
                title: '测试(大队长)-队员概况',
                showleader: false
            }
        },
        created () {
            if(this.$route.query.type == 'Smallc') {
                this.getsmalldata()
                this.type = 'small' 
                this.path = '/profile?id='+this.$route.query.id
            }else if (this.$route.query.type == 'Bigc') {
                this.getbigdata()
                this.type = 'big'
                this.path = '/profile?id='+this.$route.query.id
            }else if (this.$route.query.type == 'listname') {
                this.type = 'listname'
                this.getlistnamedata()
                this.path = '/cycledata?id='+this.$route.query.id
            }  
        },
        methods: {
            onSubmit () {
                this.$refs.search.setBlur()
                this.$vux.toast.show({
                    type: 'text',
                    position: 'top',
                    text: 'on submit'
                })
            },
            onFocus () {
                this.isshow = true
            },
            onCancel () {
                this.results = []
            },
            getItem(e) {
                this.list = [e]
            },
            getsmalldata() {
                this.$http.get('/situation', {params:this.form}).then((res)=> {
                    this.results = res.data.data.data
                })  
            },
            getbigdata() {
                this.$http.get('situation/task',{params: this.big_form_result}).then((res)=> {
                    if(res.status == 200) {
                        let list = res.data.data.data
                        list.forEach((res)=> {
                            res.arrival_warehouse_time = moment(res.arrival_warehouse_time).format('hh:mm')
                        })
                        this.results = list
                    }
                })
            },
            getlistnamedata() {
                this.$http.get('statistics', {params: this.cycledata}).then((res)=> {
                    if(res.status == 200 ) {            
                        this.results  = res.data.data.lists
                    }
                })
            }
        },
        watch: {
            list() {
                if(this.list.length >= 1) {
                    this.isshow = false
                } 
            },
            bigdateindex() {
                if(this.bigdateindex == 0) {
                    this.big_form_result.date = moment().subtract(1, 'days').format('YYYY-MM-DD')
                }else if (this.bigdateindex == 1) {
                    this.big_form_result.date = moment().format('YYYY-MM-DD')
                }else if(this.bigdateindex == 2) {
                    this.big_form_result.date = moment().add(1, 'days').format('YYYY-MM-DD')
                }
                this.getbigdata()
            }
        },
        computed: {
            result() {
                if(this.$route.query.type == 'Bigc') {
                    return this.results.filter(value => new RegExp(this.value, 'i').test(value.driver.name))
                }else { 
                    return this.results.filter(value => new RegExp(this.value, 'i').test(value.name))
                }
            },
            ...mapState(['bigdateindex','big_form_result', 'cycledata'])
        }
    }
</script>

<style lang="less">
@import './style.less';
.search {
    position: absolute;
    background: #eee;
    top:0px;
    bottom: 0;
    left: 0;
    right: 0;
    margin-top: 0;
    padding-top: 0;

    .outermost-layer{
        top: 98px;
        z-index: 100;
        background: #fff;
        overflow: hidden;
    }

    .empty {
        width: 326px;
        height: 206px;
        position: absolute;
        top: 277px;
        left: 50%;
        transform: translateX(-50%);
        img {
            width: 100%;
            height: 100%;
        }
    }
    .result_list {
        text-align: left;
        .search_list_result  {
            text-align: left;
            width: 100%;
            font-size: 30px;
            color: #333;
            li { 
                padding: 0 44px;
                line-height: 100px;
                background: #fff;
                border-bottom: 1px solid #D8D8D8;
                &:last-child {
                    border-bottom: transparent;
                }
                &:first-child {
                    margin-top: 88px;
                }
            }
        }
    }
}

</style>