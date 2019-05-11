<template>
    <div class="search">
        <header class="searchback"  @click="backtomap">
           <div class="leftarrow"></div>
           <div class="title">{{title}}</div>
        </header>
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
                <li v-for="item in result" @click='getItem(item)'>{{item.extData.name}}</li>

            </ul>
        </div>
        
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
        props: ['mapsearch'],
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
                list: this.$parent.$refs.marker,
                type: '',
                path: '',
                title: '测试(大队长)-队员概况',
                showleader: false
            }
        },
        created () {
           
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
                this.$emit('searchresult', e)
            },
            backtomap() {
                this.$emit('closeresult', '2')
            }
        },
        watch: {
            result() {
                console.log(this.result)
            },
        },
        computed: {
            result() {
                return this.list.filter(value =>  new RegExp(this.value, 'i').test(value.extData.name))
              
            },
        }
    }
</script>

<style lang="less">
@import './style.less';
.search {
    position: absolute;
    background: #eee;
    top: -340px;
    bottom: 0;
    left: 0;
    right: 0;
    margin-top: 0;
    padding-top: 0;

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
   .weui-search-bar__cancel-btn {
       width: 45px;
       color: #333;
       font-size: 14px;
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