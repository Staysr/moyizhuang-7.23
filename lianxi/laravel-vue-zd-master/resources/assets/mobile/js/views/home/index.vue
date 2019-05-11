<template>
    <div class="main">
        <m-header right="profile.index" left="close">{{$store.getters.headerPrefix}}队员概况</m-header>

        <total :total="total" :order-total="orderTotal" :big-order-total="taskOrderTotal"></total>

        <choose :no-has="noHas" :big-work="bigWork" :work="work" :no-work="noWork" @on-change="choose"></choose>

        <m-map :data="showMapData" ref="map"></m-map>

        <tools>
            <tools-item icon="position" @on-click="getView"></tools-item>
        </tools>
        <tools right>
            <tools-item icon="search" @on-click="onSearch"></tools-item>
            <tools-item icon="renovate" @on-click="search"></tools-item>
        </tools>

        <m-search left="home.index" :data="data" v-model="searchShow" @on-change="searchChange">{{$store.getters.headerPrefix}}队员概况
        </m-search>
    </div>
</template>

<script>

    import MHeader from "../../components/header/index";
    import Total from "./components/total";
    import Choose from "./components/choose";
    import MMap from "./components/map";
    import Tools from "../../components/tools/index";
    import ToolsItem from "../../components/tools/item";
    import MSearch from "../../components/search/index";

    export default {
        name: "index",
        components: {MSearch, ToolsItem, Tools, MMap, Choose, Total, MHeader},
        data() {
            return {
                data: [],
                searchIndex: 0,
                searchShow: false,
                searchData: [],
                name: ''
            }
        },
        computed: {
            realData(){
                return this.searchData.length === 0 ? this.data : this.searchData;
            },
            // 查询筛选结果
            showMapData() {
                if (this.searchIndex === 0) {
                    return this.realData
                } else if (this.searchIndex === 2) {
                    return this.realData.filter((val) => {
                        return val.is_big_work === 0 && val.is_work === 0;
                    })
                } else if (this.searchIndex === 1) {
                    return this.realData.filter((val) => {
                        return val.work_status === 1 || val.is_work === 1 || val.is_big_work === 1;
                    })
                }else if (this.searchIndex === 's_0') {
                    return this.realData.filter((val) => {
                        return val.work_status === 1 && val.is_work === 1;
                    })
                } else if (this.searchIndex === 's_1') {
                    return this.realData.filter((val) => {
                        return val.is_big_work === 1;
                    })
                } else if (this.searchIndex === 's_2') {
                    return this.realData.filter((val) => {
                        return val.work_status === 0 && val.is_work === 1;
                    })
                }
            },
            // 总人数
            total() {
                return this.data.length
            },
            // 今天小B业务接单数
            orderTotal() {
                let total = 0;
                this.data.forEach((val) => {
                    total += val.orders_count
                })
                return total
            },
            //运单中所有状态
            woringnow() {

            },
            // 今天大B业务接单数
            taskOrderTotal() {
                let total = 0;
                this.data.forEach((val) => {
                    total += val.task_orders_count
                })
                return total
            },
            // 空间状态人数
            noHas() {
                return this.realData.filter((val) => {
                    return val.work_status === 0 && val.is_work === 1 && val.is_big_work === 0;
                }).length
            },
            // 大小业务接单人数
            bigWork() {
                return this.realData.filter((val) => {
                    return val.is_big_work === 1;
                }).length
            },
            // 小B业务接单人数
            work() {
                return this.realData.filter((val) => {
                    return val.work_status === 1 && val.is_work === 1 && val.is_big_work === 0;
                }).length
            },
            // 没有工作的人数
            noWork() {
                return this.realData.filter((val) => {
                    return val.is_work === 0 && val.is_big_work === 0;
                }).length
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.search()
            })
        },
        created() {
            this.$store.commit('setLoading', true)
        },
        methods: {
            choose(index) {
                this.searchIndex = index
                setTimeout(() => {
                    this.getView()
                }, 200)
            },
            onSearch(){
                this.searchShow = true
            },
            search() {
                this.$loading('loading...');
                this.searchData = []
                this.$http.get(`map`, {params: {driver_id: this.$store.getters.userId}}).then((res) => {
                    this.data = res.data.data
                    this.$store.commit('setLoading', false)
                    this.getView()
                }).finally(() => {
                    this.$loading.close();
                })
            },
            getView() {
                this.$refs['map'].$refs['map'].$$getInstance().setFitView();
            },
            searchChange(item){
                this.$refs['map'].searchresult(item)
            }
        }
    }
</script>

<style scoped lang="less">

</style>