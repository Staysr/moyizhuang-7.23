<template>
    <div class="small">
        <search v-model="searchForm"></search>

        <i-title icon="team">
            <span style="color: #666; border-bottom: 1px ">小队长</span>
            <m-select v-if="tempData.length > 0" class="select" :data="tempData" v-model="searchForm.supervisor_id"></m-select>
        </i-title>

        <is-table :column="column" :data="data.data" class="is-table" @on-scroll-y-bottom="scrollEnd"
                  ref="is-table"></is-table>

        <tools right>
            <tools-item icon="search" @on-click="onSearch"></tools-item>
            <tools-item icon="top" @on-click="top"></tools-item>
        </tools>

        <search-remote v-model="searchShow"
                       :params="searchForm"
                       remote-url="situation"
                       :column="column"
                       :supervisor="searchForm.supervisor_id"
                       param-key="id"
                       @remote-change="search"
        >{{$store.getters.headerPrefix}}队员概况 </search-remote>
    </div>
</template>

<script>
    import Vue from 'vue'
    import Search from "./components/search";
    import ITitle from "../../../components/title/index";
    import MSelect from "../../../components/select/index";
    import IsTable from "../../../components/table/index";
    import Tools from "../../../components/tools/index";
    import ToolsItem from "../../../components/tools/item";
    import SearchRemote from "../../../components/search/remote";

    Vue.component('tools', Tools);
    Vue.component('tools-item', ToolsItem);
    

    export default {
        name: "m-small",
        components: {SearchRemote, IsTable, MSelect, ITitle, Search},
        data() {
            return {
                searchShow: false,
                toast: false,
                searchForm: {
                    supervisor_id: '',
                    last_end_work: '',
                    is_work: '',
                    work_status: '',
                    id: ''
                },
                tempData: [],
                loading: false,
                column: [
                    {
                    field: "name",
                    name: "姓名",
                    fixed: true,
                    width: 100,
                },
                {
                    width: 100,
                    name: "出车状态",
                    render: (h, {row}) => {
                        return <span>{row.is_work === 1 ? '已出车' : '未出车'}</span>
                    }
                },
                {
                    width: 100,
                    name: "在线时长",
                    render: (h, {row}) => {
                        let time = this.diffTime(row.total_work_time)
                        return <span>{time}</span>
                    }
                },
                {
                    width: 100,
                    field: "last_end_work",
                    name: "收车原因",
                },
                {
                    width: 100,
                    name: "空闲状态",
                    render: (h, {row}) => {
                        if (row.is_big_work === 1) {
                            return <span>大B运单中</span>
                        } else if (row.is_work === 0) {
                            return <span>-</span>
                        } else if (row.work_status === 1) {
                            return <span>小B运单中</span>
                        } else {
                            return <span>空闲</span>
                        }
                    }
                },
                {
                    width: 100,
                    field: "car_number",
                    name: "车牌号码",
                },
                {
                    width: 100,
                    name: "联系方式",
                    render: (h, {row}) => {
                        return <span class="phonecall" on-click={() => {this.callphone(row.phone)}}></span>
                    }
                }],
                data: {
                    data: [],   
                }
            }
        },
        mounted() {
            this.$loading('loading...');
            this.$nextTick(() => {
                if(this.$store.getters.userType === 2){
                    this.$http.get(`driver/small/${this.$store.getters.userId}`).then((res) => {
                        this.tempData = res.data.data
                        if (this.tempData.length > 0) {
                            this.searchForm.supervisor_id = this.tempData[0]['id']
                        }
                    }).finally(() => {
                    this.$loading.close();
                })
                }else{
                    this.searchForm.supervisor_id = this.$store.getters.userId
                }
            })
        },
        methods: {
            search(page = 1) {
                if (this.loading === true) {
                    return;
                }
                this.$loading('loading...');
                this.loading = true
                let form = JSON.parse(JSON.stringify(this.searchForm))
                form.page = page
                this.$http.get(`situation`, {params: form}).then((res) => {
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
            top(){
                this.$refs['is-table'].refresh()
            },
            callphone(val){
                window.location.href=`tel:${val}`
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
    .small {
        .select {
            display: inline-block;
            margin-left: 50px;
        }
        .is-table {
            height: 100%;
            box-sizing: border-box;
            padding-bottom: 226px;
        }
    }
</style>

<style lang="less">
    .small{
        .is-table{
            .rolling-table{
                /*height: auto !important;*/
            }
        }
    }
</style>