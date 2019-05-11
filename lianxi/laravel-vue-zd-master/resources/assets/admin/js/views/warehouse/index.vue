<template>
    <my-lists  v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title"><span>搜索</span></p>
            <Form ref="searchForm" :model="searchForm" inline  :label-width="60">
                <FormItem label="商户简称">
                    <remote remote-url="merchants/select" search-key="title" :remote="true"
                            v-model="searchForm.merchant_id"></remote>
                </FormItem>
                <FormItem label="仓编号">
                    <Input v-model="searchForm.id"></Input>
                </FormItem>
                <FormItem label="仓名称">
                    <Input v-model="searchForm.title"></Input>
                </FormItem>
                <FormItem label="创建时间">
                    <c-date-picker type="daterange" v-model="searchForm.create_time"></c-date-picker>
                </FormItem>
                <FormItem :label-width="1" >
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="download()" type="primary">导出</Button>
                    <Button @click="showComponent('Create')" type="primary">添加</Button>
                </FormItem>
            </Form>
        </Card>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </my-lists>
</template>

<script>
    import MyLists from "../../components/layout/my-lists";
    import lists from "../../mixins/lists";
    import CDatePicker from "../../components/date-picker/index";
    import mView from './view'
    import Update from './update'
    import Create from './create'
    import Remote from "../../components/select/remote";

    export default {
        name: "index",
        components: {Remote, CDatePicker, MyLists, mView, Update, Create},
        mixins: [lists],
        data(){
            return {
                columns: [{
                    title: '仓库编号',
                    key: 'id'
                },{
                    title: '商户简称',
                    render: (h, {row}) => {
                        return <span>{row.merchant ? row.merchant.short_name : ''}</span>
                    }
                },{
                    title: '仓名称',
                    key: 'title'
                },{
                    title: '地址',
                    key: 'address',
                    tooltip: true
                },{
                    title: '联系人',
                    key: 'contacts'
                },{
                    title: '联系电话',
                    key: 'contacts_phone'
                },{
                    title: '是否启用',
                    render: (h, {row}) => {
                        return <span>{row.status === 1? '可用' : '不可用'}</span>
                    }
                },{
                    title: '创建日期',
                    key: 'create_time'
                },{
                    title: '操作',
                    render: (h, {row}) => {
                        return (<button-group>
                            <i-button size="small" on-click={() => this.showComponent('mView', row)} >查看</i-button>
                            <i-button size="small" on-click={() => this.showComponent('Update', row)}
                                      disabled={row.order_count !== 0}>修改</i-button>
                            <poptip confirm transfer title="确定要删除吗？" on-on-ok={() => this.destroyItem(row, `warehouse/${row.id}`)}>
                                <i-button size="small" disabled={row.order_count !== 0}>删除
                                </i-button>
                            </poptip>
                        </button-group>)
                    }
                }]
            }
        },
        methods: {
            search(page = 1){
                this.loading = true;
                this.$http.get(`warehouse`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally(() => {
                    this.loading = false
                })
            },
            download() {
                this.$http.download(`warehouse/export`, this.request(), '仓库列表.xls');
            }
        }
    }
</script>

<style scoped>

</style>