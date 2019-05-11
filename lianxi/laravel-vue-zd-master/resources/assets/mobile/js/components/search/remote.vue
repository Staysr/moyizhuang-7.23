<template>
    <div class="main" v-if="value">
        <m-header @on-click-left="cancel">
            <slot></slot>
        </m-header>

        <div class="search" v-if="displaySearch">
            <search-input v-model="keyword"  @on-cancel="cancel"></search-input>
            <transition name="fade">
                <div v-if="showItems" class="scroll">
                    <item-box @on-change="change">
                        <item-input v-for="(item, index) in showValues" :name="item" :key="index">{{ item.name }}</item-input>
                    </item-box>
                </div>
            </transition>
            <div class="scroll empty" v-if="!showItems">
                <div class="icon"></div>
                <div class="text">搜索暂无结果</div>
            </div>
        </div>

        <is-table :column="column" :data="data" class="table" v-else></is-table>
    </div>
</template>

<script>
    import MHeader from "../header/index";
    import SearchInput from "./components/input";
    import ItemBox from "../item-list/box";
    import ItemInput from "../item-list/index";
    import IsTable from "../table/index";

    export default {
        name: "search-remote",
        components: {IsTable, SearchInput, MHeader, ItemBox, ItemInput},
        props: {
            value: {
                type: Boolean
            },
            supervisor: {
                type: [Number, String]
            },
            params: {
                type: Object
            },
            paramKey: {
                type: String,
                default: 'driver_id'
            },
            remoteUrl: {
                type: String,
                required: true
            },
            column: {
                type: Array,
                default: () => []
            }
        },
        data() {
            return {
                displaySearch: true,
                keyword: '',
                showValues: [],
                data: []
            }
        },
        computed: {
            showItems() {
                return this.showValues.length > 0;
            }
        },
        methods: {
            change(value) {
                let params = JSON.parse(JSON.stringify(this.params))
                params[this.paramKey] = value.id
                this.$http.get(this.remoteUrl, {params: params}).then((res) => {
                    this.data = res.data.data.data
                    this.displaySearch = false
                    this.keyword = ''
                })
            },
            cancel(){
                this.keyword = ''
                if(this.displaySearch === false){
                    this.displaySearch = true
                }else{
                    this.$emit('input', false)
                    this.$emit('remote-change')
                }
            }
        },
        watch:{
            keyword(value){
                if(value !== '') {
                    this.$http.get(`driver`, {
                        params: {
                            name: value,
                            supervisor: this.supervisor
                        }
                    }).then((res) => {
                        this.showValues = res.data.data
                    })
                }else{
                    this.showValues = []
                }
            }
        }
    }
</script>

<style scoped lang="less">
.main {
    position: absolute;
    z-index: 10000000;
    top: 0;
    bottom: 0;
    background-color: #eee;
    .scroll {
        padding-bottom: 180px;
        box-sizing: border-box;
    }
    .table{
        padding-bottom: 88px;
        /*height: 100%;*/
        box-sizing: border-box;
        width: 100%;
    }
    .empty {
        .icon {
            margin: 150px auto 0;
            width: 326px;
            height: 208px;
            background-size: 100% 100%;
            background-image: url("/images/mobile/search_icon.png");
        }
        .text {
            font-size: 28px;
            color: #ccc;
            text-align: center;
            margin-top: 20px;
        }
    }
}
</style>