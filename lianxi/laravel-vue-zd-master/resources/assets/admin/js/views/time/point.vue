<template>

        <my-list v-model="lists.data" @change="search" :columns="columns" :loading="loading">
            <Form inline>
                <FormItem :label-width="1">
                    <Button @click="download()" type="primary">导出</Button>
                </FormItem>
            </Form>
            <component :is="component.current" @on-change="hideComponent" :data="component.data"></component>
        </my-list>

</template>

<script>
    import MyList from "../../components/layout/my-lists";
    import ComponentModal from "../../components/modal/component-modal";
    import lists from "../../mixins/lists";
    import PointDetail from "./detail";

    export default {
        name: "point",
        components: {MyList, ComponentModal, PointDetail},
        mixins: [lists],
        data(){
            return {
                columns: [{
                    title: "地图位置",
                    render: (h, {row}) => {
                        if (!row.line_point) {
                            return <i-button on-click={() => this.showComponent('PointDetail', row)} size="small">位置</i-button>
                        } else {
                            return (<span><icon type="ios-checkmark-circle" style="vertical-align: top;" size="16" color="green" /><a href="javascript:void(0);">位置</a></span>);
                        }
                    }
                },{
                    title: "到仓时间",
                    render: (h, {row}) => {
                        return <span>{row.point_time.arrival_warehouse_day} {row.point_time.arrival_warehouse_time}</span>
                    }
                },{
                    title: "商户简称",
                    render: (h, {row}) => {
                        return <span>{row.point_time.warehouse.merchant.short_name}</span>
                    }
                },{
                    title: "仓名称",
                    render: (h, {row}) => {
                        return <span>{row.point_time.warehouse.title}</span>
                    }
                },{
                    title: "联系人",
                    key: "contacts"
                },{
                    title: "所在区域",
                    key: "area"
                },{
                    title: "收货地址",
                    key: "fixed_name"
                },{
                    title: "备注",
                    key: "remark"
                },{
                    title: "操作",
                    render: (h, {row}) => {
                        return (<button-group>
                                    <poptip confirm transfer title="确定删除吗？" on-on-ok={() => this.destroyItem(row, `point/${row.id}`)}>
                                        <i-button size="small">删除</i-button>
                                    </poptip>
                                </button-group>)
                    }
                }]
            }
        },
        methods: {
            search(page=1) {
                this.loading = true;
                this.$http.get(`point/${this.$route.query.id}`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data);
                }).catch((err) => {
                    this.formatErrors(err)
                }).finally(() => {
                    this.loading = false
                })
            },
            download() {
                this.$http.download(`point/export/${this.$route.query.id}`, this.request(), '配送点.xls');
            }

        }
    }
</script>

<style scoped>

</style>