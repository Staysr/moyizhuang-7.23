<template>
    <div class="big">
        <switch-box :value="1" @on-index-change="change">
            <switch-item>昨天</switch-item>
            <switch-item>今天</switch-item>
            <switch-item>明天</switch-item>
        </switch-box>

        <big-search class="search" v-model="searchForm">{{$store.getters.headerPrefix}}队员概况</big-search>
        <is-table :column="column" :data="data.data" class="is-table" @on-scroll-y-bottom="scrollEnd" ref="is-table"></is-table>


        <div class="tools right">
            <span class="item"></span>
            <span class="item"></span>
        </div>

        <div class="tools left">
            <span class="item"></span>
        </div>


        <tools right>
            <tools-item icon="search" @on-click="onSearch"></tools-item>
            <tools-item icon="top" @on-click="top"></tools-item>
        </tools>

        <search-remote v-model="searchShow" :params="searchForm" remote-url="situation/task" :column="column">{{$store.getters.headerPrefix}}队员概况 </search-remote>
    </div>
</template>

<script>
    import SwitchBox from "../../../components/switch/box";
    import SwitchItem from "../../../components/switch/item";
    import BigSearch from "./components/big-search";
    import moment from 'moment'
    import IsTable from "../../../components/table/index";
    import Tools from "../../../components/tools/index";
    import ToolsItem from "../../../components/tools/item";
    import MSearch from "../../../components/search/index";
    import SearchRemote from "../../../components/search/remote";

    export default {
        name: "big",
        components: {SearchRemote, MSearch, ToolsItem, Tools, IsTable, BigSearch, SwitchBox, SwitchItem},
        data() {
            return {
                searchShow: false,
                searchForm: {
                    date: moment().format('YYYY-MM-DD'),
                    supervisor_id: this.$store.getters.userId,
                    status: '',
                    arrival_warehouse_time: '',
                    merchant_id: '',
                    driver_id: ''
                },
                data: {data:[]},
                toast: false,
                column: [
                    {
                        name: "姓名",
                        fixed: true,
                        width: 100,
                        render: (h, {row}) => {
                            return <span
                                on-click={() => {this.push(row)}}
                                class="title-span">{row.driver ? row.driver.name : ''}</span>
                        }
                    },
                    {
                        name: "所属队长",
                        width: 100,
                        render: (h, {row}) => {
                            return <span>{row.driver.supervisor ? row.driver.supervisor.name : ''}</span>
                        }
                    },
                    {
                        name: "商户简称",
                        width: 100,
                        render: (h, {row}) => {
                            return <span>{row.merchant ? row.merchant.short_name : ''}</span>
                        }
                    },
                    {
                        name: "到仓时间",
                        width: 100,
                        render: (h, {row}) => {
                            let time = moment(row.arrival_warehouse_time).format('HH:mm')
                            return <span>{time}</span>
                        }
                    },
                    {
                        name: "出车单状态",
                        width: 100,
                        render: (h, {row}) => {
                            switch (row.status) {
                                case 0:
                                    return <span style="color: #F32F00;">未签到</span>
                                    break;
                                case 1:
                                    return <span>已签到</span>
                                    break;
                                case 2:
                                    return <span>配送中</span>
                                    break;
                                case 3:
                                    return <span>配送完成</span>
                                    break;
                                case 4:
                                    return <span>设置不配送</span>
                                    break;
                                case 5:
                                    return <span>无责任解约</span>
                                    break;
                                case 6:
                                    return <span>运营取消</span>
                                    break;
                            }
                        }
                    }
                ]
            }
        },
        mounted() {
            this.search()
        },
        methods: {
            change(index) {
                if (index === 0) {
                    this.searchForm.date = moment().subtract(1, 'days').format('YYYY-MM-DD')
                }
                if (index === 1) {
                    this.searchForm.date = moment().format('YYYY-MM-DD')
                }
                if (index === 2) {
                    this.searchForm.date = moment().add(1, 'days').format('YYYY-MM-DD')
                }
            },
            search(page = 1) {
                this.$loading('loading...');
                if (this.loading === true) {
                    return;
                }
                this.loading = true
                let form = JSON.parse(JSON.stringify(this.searchForm))
                form.page = page
                this.$http.get(`situation/task`, {params: form}).then((res) => {
                    let data = JSON.parse(JSON.stringify(res.data.data))
                    let data1 = JSON.parse(JSON.stringify(this.data.data))
                    data.data = data.data.concat(data1)
                    this.data = data
                    this.loading = false
                    if(page){
                        this.top()
                    }
                }).finally(() => {
                    this.$loading.close();
                })
            },
            onSearch(){
                this.searchShow = true
            },
            scrollEnd() {
                if (this.data.current_page < this.data.last_page) {
                    this.search(this.data.current_page + 1)
                } else {
                    this.$toast.center('最后一页面没有数据了！');
                }
            },
            push(row){
                this.$router.push({
                    name: 'profile.big-show',
                    params: {id: row}
                })
            },
            top(){
                this.$refs['is-table'].refresh()
            }
        },
        watch: {
            searchForm: {
                deep: true,
                handler(value) {
                    this.data = {data: []}
                    this.search();
                }
            }
        }
    }
</script>

<style scoped lang="less">

    .big{
        .is-table {
            height: 100%;
            box-sizing: border-box;
            padding-bottom: 197px;
        }
        .search {
            margin-top: 20px;
        }
    }
</style>
<style>
    .title-span{
        color: #07ca61 !important;
    }
</style>