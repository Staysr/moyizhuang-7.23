<template>
    <component-modal title="选中出车单" :width="900">
        <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
            <Card>
                <p slot="title"><span>搜索</span></p>
                <Form ref="searchForm" :model="searchForm" inline :label-width="60">
                    <FormItem label="司机姓名">
                        <remote remote-url="driver/select" search-key="title" :remote="true"
                                v-model="searchForm.driver_id"></remote>
                    </FormItem>
                    <FormItem label="配送时间" >
                        <c-date-picker v-model="searchForm.arrival_warehouse_time" :options="options" type="daterange" style="width: 240px" ></c-date-picker>
                    </FormItem>

                    <FormItem :label-width="20">
                        <Button @click="search(1)" type="primary">搜索</Button>
                    </FormItem>
                </Form>
            </Card>
        </my-lists>
    </component-modal>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import CDatePicker from "../../../components/date-picker/index";
    import Remote from "../../../components/select/remote";
    import CalendarPicker from '../../../components/month-picker/index'
    import Box from "../../../components/box/index";
    import ComponentModal from "../../../components/modal/component-modal";

    export default {
        name: "index",
        components: {
            ComponentModal,
            Remote,
            CDatePicker,
            MyLists,
            CalendarPicker,
            Box

        },
        mixins: [lists],
        data() {
            return {
                options: {},
                columns: [
                    {
                        title: '司机姓名',
                        width: 100,
                        render: (h, {row}) => {
                            return <span>{row.driver ? row.driver.name : ''}</span>
                        }
                    },
                    {
                        title: '出车单号',
                        key:'order_no'
                    },
                    {
                        title: '到仓时间',
                        width: 150,
                        key:'arrival_warehouse_time'
                    },
                    {
                        title: '线路名称',
                        render: (h, {row}) => {
                            return <span>{row.task ? row.task.name : ''}</span>
                        }
                    },
                    {
                        title: '仓库',
                        render: (h, {row}) => {
                            return <span>{row.warehouse ? row.warehouse.title : ''}</span>
                        }
                    },

                    {
                        title: '操作',
                        render: (h, {row}) => {
                            return (<button-group>
                                <i-button size="small" on-click={() => this.choose(row)}>选中</i-button>
                            </button-group>)
                        }
                    },
                ]
            }
        },
        methods: {
            search(page = 1) {
                this.loading = true
                let arr=this.searchForm.arrival_warehouse_time;
                if(arr!==undefined){
                    for (var k = 0, length =arr.length; k < length; k++) {
                        arr[k]=arr[k]+' 00:00:00';
                    }
                }
                this.searchForm.arrival_warehouse_time=arr;
                this.$http.get(`order`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally(() => {
                    this.loading = false
                });
            },
            download() {
                this.$http.download(`award/export`, this.request(), '司机奖惩.xls');
            },
            choose(row) {
                this.$emit('on-change', row)
            }
        }
    }
</script>

<style scoped>

</style>