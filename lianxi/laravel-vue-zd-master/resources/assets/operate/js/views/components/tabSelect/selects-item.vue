<template>
    <div>
        <div class="layout">

            <div v-for="(item, index) in carstate" 
            v-bind:class="{selectItem, selected_item: index == selindex} " 
            @click="selectItem(index, item, index == selindex)" 
            ref="selectbox">
                <div class="label">
                    <span class="selUp" v-show="index != selindex"></span>
                    <span class="selDown" v-show="index == selindex"></span>
                </div>
                {{item.name}}
            </div>
            
            <div class="selResult">
                <div class="selResult_info" v-show="selinfo_show">
                    <div 
                    v-for="(item, index) in result" 
                    v-bind:class="{selected_div: index == resultindex }"
                    @click="chooseResultItem(index, item)"
                    >{{ typeof item == 'object' ? item.short_name : item}}
                    </div>
                </div>
            </div>
            
        </div>
        <div class="layout_cover" v-show="isshow"></div>

    </div>
</template>

<script>
import {mapState,MapMutations} from 'vuex'

    export default {
        name: 'select',
        props: {
            carstate: {
                type: Array
            }
        },
        created () {
            this.selindex = undefined

        },
        data () {
            return {
                selindex: '',
                result: [],
                resultindex: '',
                selinfo_show: true,
                isshow: '',
                resultitem: '',
                shopping : []
            }
        },
        methods: {
            selectItem(index, item, e ){
                this.selindex = index
                this.result = item.items
                this.selinfo_show = true
                this.isshow = true

            },
            chooseResultItem(index, item) {

                if(this.selindex == 0 && index != 0) {
                    
                    this.formresult.is_work = index-1
                    this.big_form_result.merchant_id = item.id

                }else if (this.selindex == 1 && index != 0) {
                    
                    let arr = item.split('-')
                    this.big_form_result.arrival_warehouse_time = arr
                    this.formresult.work_status = index-1
                
                }else if (this.selindex == 2 && index != 0) {

                    this.big_form_result.status = index - 1
                    this.formresult.last_end_work = item

                }else if ( this.selindex == 0 && index == 0 ) {

                    this.formresult.is_work = ''

                }else if ( this.selindex == 1 && index == 0 ) {

                    this.big_form_result.arrival_warehouse_time = []
                    this.formresult.work_status = ''

                }else if ( this.selindex == 2 && index == 0 ) {

                    this.big_form_result.status = ''
                    this.formresult.last_end_work = ''

                }

                this.selinfo_show = false
                this.resultindex = index
                this.isshow = false
                    // this.selindex = undefined
                this.$emit('changetabs', index)
                
            }
        },
        watch: {
            resultindex() {
                if(this.selindex == 0) {
                    this.$store.commit('indexone', this.resultindex)
                    
                }else if(this.selindex == 1) {
                    this.$store.commit('indextwo', this.resultindex)
                }else if(this.selindex == 2) {
                    this.$store.commit('indexthree', this.resultindex)
                }
            },
            selindex() {
                if(this.selindex == 0) {
                    this.resultindex = this.selone
                }else if(this.selindex == 1) {
                    this.resultindex = this.seltwo
                }else if(this.selindex == 2) {
                    this.resultindex = this.selthree
                }
            },
        },
        computed: {
            ...mapState(['big_form_result','formresult', 'delivery','selone','seltwo','selthree']),
            // ...mapMutations(['indexone','indextwo','indexthree'])
            
        }
    }
</script>

<style lang="less"> 
    .layout {
        width: 100%;
        height: auto;
        z-index: 30;
        position: relative;

        

        .selectItem {
            width: 33.333%;
            line-height: 88px;
            background: #fff;
            float: left;
            color: #333;
            font-size: 32px;
            text-align: center;
            position: relative;
        }

        .selResult {
            width: 100%;
            background: #fff;
            z-index: 30;
            font-size: 30px;
            color: #333;
            text-align: left;
            position: absolute;
            
            
            .selResult_info {
                border-top: 1px solid #eee;
                padding: 0 20px;

                div{
                    border-bottom: 1px solid #eee;
                    line-height: 88px;
                    padding-left: 20px;
                }
                
                .selected_div {
                    color: #07CA61!important;
                    position: relative;
                    &::before {
                        content: "";
                        height: 16px;
                        width: 3px;
                        background: #07CA61;
                        display: inline-block;
                        transform: rotate(-45deg);
                        position:absolute;
                        right: 40px;
                        bottom: 22px;
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
                        bottom: 21px;
                    }
                }
            }
        }
        .label {
            z-index: 30;
           
            .selUp {
                border-top: 13px solid #969696;
                border-bottom: 13px solid transparent;
                border-left: 13px solid transparent;
                border-right: 13px solid transparent;
                display:inline-block;
                position: absolute;
                left: 200px;
                bottom: 25px;
            }
            .selDown {
                border-top: 13px solid transparent;
                border-bottom: 13px solid #07CA61;
                border-left: 13px solid transparent;
                border-right: 13px solid transparent;
                display:inline-block;
                 position: absolute;
                left: 205px;
                bottom: 40px;    
            }
        }
    }
    .layout_cover {
        position: fixed;
        left: 0;
        bottom: 0;
        right: 0;
        background: rgba(0,0,0,.2);
        z-index: 10;
    }
    
    .selected_item {
        color: #07CA61!important;
        position: relative;
    }
    
   

</style>