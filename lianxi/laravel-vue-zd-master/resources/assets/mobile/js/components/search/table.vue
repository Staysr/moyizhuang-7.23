<template>
    <div class="main" v-if="value">
        <m-header @on-click-left="cancel">
            <slot></slot>
        </m-header>

        <search-input v-if="!tableShow" v-model="keyword"  @on-cancel="cancel" class="search"></search-input>

        <transition name="fade">
            <div v-if="showItems && !tableShow" class="scroll">
                <item-box @on-change="change">
                    <item-input v-for="(item, index) in showValues" :name="item" :key="index">{{ formatField
                        (item) }}</item-input>
                </item-box>
            </div>
        </transition>

        <div class="scroll empty" v-if="!showItems && !tableShow">
            <div class="icon"></div>
            <div class="text">搜索暂无结果</div>
        </div>

        <is-table v-if="tableShow" :column="column" :data="lists" class="search-is-table"></is-table>
    </div>
</template>

<script>
    import SearchInput from "./components/input";
    import MHeader from "../header/index";

    import ItemBox from "../item-list/box";
    import ItemInput from "../item-list/index";
    import IsTable from "../table/index";


    export default {
        name: "m-search-table",
        components: {IsTable, ItemInput, ItemBox, SearchInput, MHeader},
        props: {
            data: {
                type: Array,
                default: () => []
            },
            value: {
                type: Boolean,
                default: false
            },
            searchField:{
                type: String,
                default: 'name'
            }
        },
        data() {
            return {
                keyword: '',
                showValues: [],
                lists: [],
                tableShow: false,
                column: [
                    {
                        name: "姓名",
                        fixed: true,
                        width: 100,
                        field: 'name'
                    }, {
                        name: "小B完成数",
                        width: 100,
                        field: 'order_complete_total'
                    }, {
                        name: "小B取消数",
                        width: 100,
                        field: 'order_cancel_total'
                    }, {
                        name: "小B金额",
                        width: 100,
                        field: 'order_complete_fee'
                    }, {
                        name: "大B金额",
                        width: 100,
                        field: 'task_order_fee'
                    },{
                        name: '在线时长',
                        width: 100,
                        field: 'work_time',
                        render: (h, {row}) => {
                            let hours = this.diffTime(Number(row.work_time))
                            return <span>{hours}</span>
                        }
                    }, {
                        name: "大B单数",
                        width: 100,
                        field: 'task_order_total'
                    }, {
                        name: "大B人均金额",
                        width: 100,
                        render: (h, {row}) => {
                            return <span>{isNaN(Number(row.task_order_fee) / Number(row.task_order_total)) ? 0 : (Number(row.task_order_fee) / Number(row.task_order_total)).toFixed(2)}</span>
                        }
                    }, {
                        name: "总金额",
                        width: 100,
                        render: (h, {row}) => {
                            return <span>{((Number(row.task_order_fee) + Number(row.order_complete_fee)).toFixed(2))}</span>
                        }
                    }]
            }
        },
        computed: {
            showItems() {
                return this.showValues.length > 0;
            }
        },
        methods: {
            change(value) {
                this.lists  = [value]
                this.$emit('on-change', value)
                // this.$emit('input', false)
                this.keyword = ''
                this.tableShow = true
            },
            cancel() {
                this.tableShow = false
                this.$emit('input', false)
                this.keyword = ''
            },
            formatField(item){
                let arr = this.searchField.split('.');
                arr.forEach((key) => {
                    item = item[key] || ''
                })
                return item
            },
            diffTime(diff) {
                //计算出小时数
                let leave1 = diff % (24 * 3600);    //计算天数后剩余的毫秒数
                let hours = Math.floor(leave1 / (3600));
                //计算相差分钟数
                let leave2 = leave1 % (3600);        //计算小时数后剩余的毫秒数
                let minutes = Math.floor(leave2 / (60));


                return `${hours}:${minutes}`;
            }
        },
        watch: {
            keyword(value){
                if (value === '') {
                    this.showValues =  []
                }else{
                    this.showValues = this.data.filter((val) => {
                        let item = this.formatField(val)
                        return item.indexOf(value) > -1
                    })
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
        .search,.search-is-table{
            margin-top: 88px ;
        }
        .scroll {
            padding-bottom: 180px;
            box-sizing: border-box;
        }
        .empty {
            color: #666;
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