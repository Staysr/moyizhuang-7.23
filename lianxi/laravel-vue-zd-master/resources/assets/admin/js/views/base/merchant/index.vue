<template>
    <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title"><span>搜索</span></p>
            <Form ref="searchForm" :model="searchForm" inline>
                <FormItem prop="id" label="商户简称" :label-width="60">
                    <remote remote-url="merchants/select" v-model="searchForm.id"></remote>
                </FormItem>
                <FormItem prop="status" label="商户状态" :label-width="60">
                    <true-or-false true-value="开启" false-value="关闭" v-model="searchForm.status"></true-or-false>
                </FormItem>
                <FormItem prop="quality_id" label="品质交付经理" :label-width="90">
                    <remote v-model="searchForm.quality_id" remote-url="admin/select"
                            :params="{authority_level: 4}"></remote>
                </FormItem>
                <FormItem prop="advice_id" label="客户经理" :label-width="60">
                    <remote v-model="searchForm.advice_id" remote-url="admin/select"
                            :params="{authority_level: 1}"></remote>
                </FormItem>
                <FormItem prop="running_id" label="运作经理" :label-width="60">
                    <remote v-model="searchForm.running_id" remote-url="admin/select"
                            :params="{authority_level: 2}"></remote>
                </FormItem>
                <FormItem label="创建时间" :label-width="60">
                    <c-date-picker type="daterange" v-model="searchForm.create_time"></c-date-picker>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="download()" type="primary">导出</Button>
                    <Button @click="showComponent('Create')" type="warning">添加</Button>
                </FormItem>
            </Form>
        </Card>
        <component :is="component.current" @on-change="hideComponent" :data="component.data"></component>
    </my-lists>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import TrueOrFalse from "../../../components/select/true-or-false";
    import CDatePicker from "../../../components/date-picker/index";
    import iView from './view';
    import Create from './create'
    import Remote from "../../../components/select/remote";
    import Contract from './contract'


    export default {
        components: {Remote, CDatePicker, TrueOrFalse, MyLists, iView, Create,Contract},
        name: "index",
        mixins: [lists],
        data(){
            return {
                columns: [{
                    title: '商户编号',
                    render: (h, {row}) => {
                        return <a on-click={() => this.showComponent('iView', row)}>{row.id}</a>
                    }
                },{
                },{
                    title: '商户手机号',
                    render: (h, {row}) => {
                        return <span>{row.content ? row.content.contacts_phone : ''}</span>
                    }
                },{
                    title: '商户全称',
                    key: 'title'
                },{
                    title:
                        '商户简称',
                    key: 'short_name'
                },{
                    title: '品质交付经理',
                    render: (h, {row}) => {
                        return <span>{row.quality ? row.quality.name : ''}</span>
                    }
                },{
                    title: '客户经理',
                    render: (h, {row}) => {
                        return <span>{row.advice ? row.advice.name : ''}</span>
                    }
                },{
                    title: '运作经理',
                    render: (h, {row}) => {
                        return <span>{row.running ? row.running.name : ''}</span>
                    }
                },{
                    title: '行业',
                    key: 'trade'
                },{
                    title: 'sop',
                    render: (h , {row}) => {
                        return <span>{row.sop ? '开启' : '关闭'}</span>
                    }
                },{
                    title: '所属城市',
                    key: 'city'
                },{
                    title: '仓库录入记录',
                    key: 'warehouse_count'
                },{
                    title: '发任务数',
                    key: 'task_count'
                },{
                    title: '任务作废数',
                    key: 'unless_task_count'
                },{
                    title: '商户账户状态',
                    render: (h, {row}) => {
                        return <span>{row.status ? '开启' : '关闭'}</span>
                    }
                },{
                    title: '是否开票',
                    render: (h, {row}) => {
                        return <span>{row.invoice ? '需要' : '不需要'}</span>
                    }
                },{
                    title: '创建日期',
                    key: 'create_time'
                },{
                    title: '创建人',
                    render: (h , {row}) => {
                        return <span>{row.creator ? row.creator.name : ''}</span>
                    }
                },{
                    title: '合同张数',
                    key:'contract_count'
                },
                    {
                        title: '合同管理',
                        render: (h, {row}) => {
                            return (<button-group>
                                <i-button size="small" on-click={() => this.showComponent('Contract', row)}>修改</i-button>
                            </button-group>)
                        }
                    }
                   ]
            }
        },
        methods: {
            search(page = 1){
                this.loading = true
                this.$http.get(`merchants`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally(() => {
                    this.loading = false
                })
            },
            download() {
                this.$http.download(`merchants/export`, this.request(), '商户列表.xls');
            }
        }
    }
</script>

<style scoped>

</style>