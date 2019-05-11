<template>
    <div class="scroll">
        <m-header left="statistics.index">{{$store.getters.headerPrefix}}-队员概览</m-header>
        <collection :date-type="type" :type="1" :lists="data.lists" :small-lists="data.small_lists"
                    :data="data.data" ref="collection" :name="$route.query.driver_name"></collection>

        <tools right>
            <tools-item icon="search" @on-click="onSearch"></tools-item>
            <tools-item icon="top" @on-click="top"></tools-item>
        </tools>

        <m-search v-model="searchShow" :data="data.lists" @on-change="change">{{$store.getters.headerPrefix}}-队员概览</m-search>
    </div>
</template>

<script>
    import Collection from "./components/collection";
    import MyHeader from "../../../../admin/js/components/layout/my-header";
    import MHeader from "../../components/header/index";
    import MSearch from "../../components/search/table";
    import Tools from "../../components/tools/index";
    import ToolsItem from "../../components/tools/item";
    export default {
        name: "show",
        components: {ToolsItem, Tools, MSearch, MHeader, MyHeader, Collection},
        data() {
            return {
                data: {},
                type: this.$route.query.type,
                searchShow: false,
                lists: []
            }
        },
        mounted(){
            this.search()
        },
        methods: {
            search(){                
                this.$loading('loading...');
                this.lists = []
                let searchForm = {
                    start_date: this.$route.query.start_date,
                    end_date: this.$route.query.end_date,
                    driver_id: this.$route.query.driver_id,
                    type: 1,
                }
                this.$http.get(`statistics`, {params: searchForm}).then((res) => {
                    this.data = res.data.data
                    this.lists = JSON.parse(JSON.stringify(res.data.data.lists))
                }).finally(() => {
                    this.$loading.close();
                })
            },
            change(item){
                this.lists = [item]
            },
            onSearch(){
                this.searchShow = true
            },
            top(){
                this.$refs['collection'].$refs['is-table'].refresh()
            }
        }
    }
</script>

<style scoped>
</style>