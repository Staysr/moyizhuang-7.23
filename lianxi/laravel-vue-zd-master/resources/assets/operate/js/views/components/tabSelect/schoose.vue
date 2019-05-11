<template>
    <div class="schoose">
        <img src="../../../../images/team.png" class="schoose_img" alt="">
        <span class="schoose_name">小队长</span>
        <div v-show="datatype == 'leaderdetail' ">
            <div class="date_list">
                <span class="schoose_list_name">
                    {{cycleleader.name}}
                </span>
            </div>
        </div>
        
        <div v-show='type == "small" && list.length != 0'>
            <div class="schoose_list">
                <span class="schoose_list_name" @click="()=> {if(list.length > 0) isshow = true}">
                    {{leaderName}}
                </span>
            </div>
        </div>
            <div class="schoose_result" v-show="isshow">
                <ul class="schoose_result_ul">
                    <li 
                    v-for="(item, index) in list" 
                    @click="chooseitem(item,index)"
                    v-bind:class="{selected_div_schoose: index == resultindex }"
                    >{{item.name}}</li>
                </ul>   
            </div>
            <div class="cover" v-show="isshow">
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex'
import {mapMutations} from 'vuex'

    export default {
        props: {
            smallname:{
                type: String
            },
            showlist: {
                type: Boolean
            },
            datatype: {
                type: String
            },
            tabindex: {
                type: Number
            },
        },
        computed: { ...mapState(['supervisorid','cycleleader'])},
        data() {
            return {
                leaderName: '',
                isshow: false,
                list: [],
                resultindex: '',
                type: '',
                index: '',
                detailname: ''
            }
        },
        watch: {
            smallname() {
               if(this.type != 'small') {
                    this.leaderName = this.smallname
                    this.isshow = false
               }else {
                   this.isshow = true
               }
            },
            list() {
                if(this.type == 'small') {
                    this.$store.commit('getsupervisor', this.list[0])
                }
            },
            cycleleader() {
               this.detailname = this.cycleleader.name
            },
        },
        created() {
            if(this.type == 'small') {
                this.resultindex = 0
            }
            this.type = this.datatype
            this.getdata()
            this.index= this.tabindex

        },
        methods: {
            chooseitem(item,index) {
                this.resultindex = index;
                this.leaderName = item.name
                this.isshow = false
                 if(this.type == 'small') {
                    this.$store.commit('getsupervisor', item)
                }
            },
            getdata() {
                if(this.$mobile.user().type === 2){
                    this.$http.get(`driver/small/${this.$mobile.user().id}`).then((res)=> {
                        if(res.status == 200 && res.data.data.length != 0) {
                            this.list = res.data.data
                            this.leaderName = this.list[0].name
                        }
                    })
                }else{
                    this.$store.commit('getsupervisor', this.$mobile.user())
                }
            }
        }
    }
</script>

<style lang="less">
.schoose {
    line-height: 128px;
    width: 100%;
    position: relative;
    font-size: 36px;
    color: #333;
    margin-top: 0;
    paddding-top: 0;
    background: #fff;

    .schoose_name {
        margin-left: 19px;
    }
    .schoose_img {
        height: 50px;
        width: 50px;
        vertical-align: middle;
        margin-left: 20px;

    }
    .date_list {
        position: absolute;
        top: 0;
        left: 255px;
        vertical-align: middle;
        .schoose_item {
            width: 100%;
            line-height: 92px;
            text-align: left;
            background: #fff;
        }
    }
    .schoose_list {
        position: absolute;
        top: 0;
        left: 255px;
        vertical-align: middle;
        .schoose_list_name {
            &::after {
                content: "";
                position:absolute;
                top: 45%;
                right: -50px;
                border-left: 15px solid transparent;
                border-right: 15px solid transparent;
                border-top: 15px solid #969696;
                border-bottom: 15px solid transparent;
            }
        }
        
        .schoose_item {
            width: 100%;
            line-height: 92px;
            text-align: left;
            background: #fff;
        }
    }
    .schoose_result {
        position: absolute;
        background: #fff;
        width: 100%;
        z-index: 55;
        top: 126.5px;
        text-align: left;
        .schoose_result_ul {
            padding: 0 20px;
            line-height: 92px;
            font-size: 30px;
            color: #333;
            text-align: left;
            
            li {
                width: 100%;
                border-bottom: 1px solid #D8D8D8;
                &:last-of-type {
                    border-bottom: 1px solid transparent;
                }
                &:first-of-type {
                    border-right: none;
                }
            }
        }
    }
    .cover {
        position: fixed;
        top: 420px;
        left: 0;
        bottom: 0;
        right: 0;
        background: rgba(0, 0, 0, .2);
        z-index: 10;
    }
     .selected_div_schoose {
         text-align: left;
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
</style>