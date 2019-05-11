<template>
    <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title"><span>搜索</span></p>
            <Form ref="searchForm" :model="searchForm" inline :label-width="60">
                <FormItem label="司机姓名">
                    <remote remote-url="driver/select" search-key="name" :remote="true"
                            v-model="searchForm.driver_id"></remote>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="download()" type="primary">导出</Button>
                </FormItem>
            </Form>
            <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
        </Card>
    </my-lists>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import Remote from "../../../components/select/remote";
    import Bview from "./bview";


    export default {
        name: "index",
        components: {Remote, MyLists,Bview},
        mixins: [lists],
        data() {
            return {
                columns: [
                    {
                        title: '司机姓名',
                        render: (h, {row}) => {
                            return <span>{row.driver ? row.driver.name : ''}</span>
                        }
                    },
                    {
                        title: '所属队长',
                        render: (h, {row}) => {
                            return <span>{row.driver.supervisor ? row.driver.supervisor.name : ''}</span>
                        }
                    },
                    {
                        title: '司机手机',
                        render: (h, {row}) => {
                            return <span>{row.driver ? row.driver.phone: ''}</span>
                        }
                    },
                    {
                        title: '车型',
                        render: (h, {row}) => {
                            return <span>{row.driver.car_type ? row.driver.car_type.name : ''}</span>
                        }
                    },
                    {
                        title: '车牌号码',
                        render: (h, {row}) => {
                            return <span>{row.driver.car_number ? row.driver.car_number : ''}</span>
                        }
                    },
                    {
                        title: '成功配送次数',
                        key:'complete_count'
                    },
                    {
                        title: '上岗次数',
                        key:'work_count'
                    },
                    {
                        title: '账单金额',
                        key: 'sum_total_fee'
                    },
                    {
                        title: '账户明细',
                        render: (h, {row}) => {
                            return (<button-group>
                                <i-button size="small" on-click={() => this.showComponent('Bview', row)} >账户明细</i-button>
                            </button-group>)
                        }
                    }
                ]
            }
        },
        methods: {
            search(page = 1) {
                this.loading = true
                this.$http.get(`account/driver`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally(() => {
                    this.loading = false
                });
            },
            download() {
                this.$http.download(`account/export`, this.request(), '司机账户账单.xls');
            }
        }
    }
</script>

<style scoped>

</style>