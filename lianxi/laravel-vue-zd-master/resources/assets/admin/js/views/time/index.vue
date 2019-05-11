<template>
    <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <Form ref="searchForm" v-model="searchForm" inline :label-width="60">

                <FormItem label="商户简称">
                    <remote remote-url="merchants/select" search-key="title" :remote="true"
                            v-model="searchForm.merchant_id"></remote>
                </FormItem>

                <FormItem label="创建时间" :label-width="60">
                    <c-date-picker type="daterange" v-model="searchForm.date"></c-date-picker>
                </FormItem>

                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                </FormItem>

                <FormItem :label-width="1">
                    <Button type="primary" @click="showComponent('Import')">导入</Button>
                </FormItem>

            </Form>
            <component :is="component.current" @on-change="hideComponent" :data="component.data"></component>
        </Card>
    </my-lists>
</template>

<script>
    import MyLists from "../../components/layout/my-lists";
    import lists from "../../mixins/lists";
    import Remote from "../../components/select/remote";
    import CDatePicker from "../../components/date-picker/index";
    import LineView from "./line-view";
    import Import from "./import";

    export default {
        name: "index",
        mixins: [lists],
        data() {
            return {
                columns: [{
                    title: "导入日期",
                    key: 'create_time'
                },{
                    title: "商户简称",
                    render: (h, {row}) => {
                        return <span>{row.warehouse.merchant.short_name}</span>
                    }
                },{
                    title: "仓库名称",
                    render: (h, {row}) => {
                        return <span>{row.warehouse.title}</span>
                    }
                },{
                    title: "到仓时间",
                    render: (h, {row}) => {
                        return <span>{row.arrival_warehouse_day} {row.arrival_warehouse_time}</span>
                    }
                },{
                    title: "导入个数",
                    key: "total_count"
                },{
                    title: "未排线个数",
                    render: (h, {row}) => {
                        return <span>{row.total_count-row.plan_count}</span>
                    }
                },{
                    title: "配送点信息",
                    render: (h, {row}) => {
                        return <i-button on-click={() => this.$router.push({name: 'point.index', query: {id: row.id}})} size="small">查看</i-button>
                    }
                },{
                    title: "操作",
                    render: (h, {row}) => {
                        return <i-button on-click={() => this.showComponent('LineView', row)} size="small">地图排线</i-button>
                    }
                }]
            }
        },
        methods: {
            search(page = 1 ) {
                this.loading = true;
                if (this.searchForm.date == undefined) {
                    this.searchForm.date = [
                            new Date().getFullYear() +"-"+ (new Date().getMonth()+1) + "-" + new Date().getDate(),
                            new Date().getFullYear() +"-"+ (new Date().getMonth()+1) + "-" + new Date().getDate()
                        ]
                }
                this.$http.get(`time`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data);
                }).finally(() => {
                    this.loading = false;
                })
            }
        },
        components: {MyLists, Remote, CDatePicker, LineView, Import}
    }
</script>

<style scoped>

</style>