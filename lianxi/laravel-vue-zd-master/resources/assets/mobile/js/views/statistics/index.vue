<template>
    <div class="scroll">
        <m-header left="profile.index">{{$store.getters.headerPrefix}}队员概况</m-header>
        <div class="fixed">
            <switch-box v-model="index" @on-index-change="change">
                <switch-item>日数据</switch-item>
                <switch-item>周数据</switch-item>
                <switch-item>月数据</switch-item>
            </switch-box>
            <choose-date :type="type" v-model="date"></choose-date>
        </div>

        <collection class="collection" :date-type="type" :type="driverType" :lists="data.lists"
                    :small-lists="data.small_lists"
                    :data="data.data" @on-change="push" ref="collection"></collection>

        <tools right v-if="driverType === 1">
            <tools-item icon="search" @on-click="onSearch"></tools-item>
            <tools-item icon="top" @on-click="top"></tools-item>
        </tools>

        <m-search v-if="driverType === 1" v-model="searchShow" :data="data.lists" @on-change="changeSearch">{{$store.getters.headerPrefix}}队员概况 </m-search>

    </div>
</template>

<script>
    import MHeader from "../../components/header/index";
    import SwitchBox from "../../components/switch/box";
    import SwitchItem from "../../components/switch/item";
    import ChooseDate from "./components/choose-date";
    import Collection from "./components/collection";
    import Tools from "../../components/tools/index";
    import ToolsItem from "../../components/tools/item";
    import MSearch from "../../components/search/table";
    import IsTable from "../../components/table/index";


    export default {
        name: "index",
        components: {IsTable, MSearch, ToolsItem, Tools, Collection, ChooseDate, SwitchItem, SwitchBox, MHeader},
        data() {
            return {
                index: 0,
                type: 'Date',
                date: [],
                driverType: this.$store.getters.userType || 1,
                data: {},
                searchShow: false,
                lists: []
            }
        },
        methods: {
            change(index) {
                if (index === 0) {
                    this.type = 'Date'
                } else if (index === 1) {
                    this.type = 'Week'
                } else {
                    this.type = 'Month'
                }
            },
            push(item) {
                this.$router.push({
                    name: 'statistics.show',
                    query: {
                        start_date: this.date[0],
                        end_date: this.date[1],
                        type: this.type,
                        driver_id: item.driver_id,
                        driver_name: item.name
                    }
                })
            },
            search() {
                let searchForm = {
                    start_date: this.date[0],
                    end_date: this.date[1],
                    driver_id: this.$store.getters.userId,
                    type: this.driverType,
                }
                
                this.$loading('loading...');
                this.$http.get(`statistics`, {params: searchForm}).then((res) => {
                    this.data = res.data.data
                }).finally(() => {
                    this.$loading.close();
                })
            },
            changeSearch(item) {
                this.lists = [item]
                this.searchShow = false
                this.tableShow = true
            },
            onSearch() {
                this.searchShow = true
            },
            top() {
                this.$refs['collection'].$refs['is-table'].refresh()
            }
        },
        watch: {
            date: {
                deep: true,
                handler(value) {
                    this.search();
                }
            }
        }
    }
</script>

<style scoped lang="less">
    .scroll {
        .fixed{
            position: fixed;
            width: 100%;
            z-index: 999;
        }
        .collection{
            padding-top: 176px !important;
            box-sizing: border-box;
        }
        .search-is-table{
            position: absolute;
            z-index: 1000;
        }
    }
</style>