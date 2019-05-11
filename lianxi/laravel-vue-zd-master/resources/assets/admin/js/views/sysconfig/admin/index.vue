<template>
    <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title">
                <span>搜索</span>
            </p>
            <Form ref="searchForm" :model="searchForm" :label-width="80" inline>
                <FormItem prop="phone" label="手机号码" :label-width="60">
                    <Input type="text" v-model="searchForm.phone" placeholder="手机号码" clearable></Input>
                </FormItem>
                <FormItem prop="name" label="用户姓名" :label-width="60">
                    <Input type="text" v-model="searchForm.name" placeholder="用户姓名" clearable></Input>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="showComponent('Create')" type="warning">添加</Button>
                </FormItem>
            </Form>
        </Card>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </my-lists>
</template>

<script>
    import MyLists     from '../../../components/layout/my-lists'
    import lists       from '../../../mixins/lists'
    import Update      from './update'
    import Create      from './create'
    import TrueOrFalse from '../../../components/select/true-or-false'

    export default {
        name: 'index',
        components: {
            TrueOrFalse,
            MyLists, Create, Update
        },
        mixins: [lists],
        data () {
            return {
                columns: [
                    {
                        title: '用户姓名',
                        render: (h, {row}) => {
                            return (<span>{row.name}</span>)
                        }
                    },
                    {
                        title: '手机号码',
                        key: 'phone'
                    },
                    {
                        title: '所属角色',
                        render: (h, {row}) => {
                            return (<span>{row.roles ? row.roles.name : ''}</span>)
                        }
                    },
                    {
                        title: '数据权限',
                        render (h, {row}) {
                            switch (row.authority_level) {
                                case 0:
                                    return (<span>全部</span>)
                                    break
                                case 1:
                                    return (<span>客户顾问</span>)
                                    break
                                case 2:
                                    return (<span>运行经理</span>)
                                    break
                                case 3:
                                    return (<span>拓展经理</span>)
                                    break
                                case 4:
                                    return (<span>品质交互经理</span>)
                                    break
                            }
                        }
                    },
                    {
                        title: '状态',
                        render: (h, {row}) => {
                            return (<span>{row.status === 1 ? '开启' : '关闭'}</span>)
                        }
                    },
                    {
                        title: '操作',
                        render: (h, {row}) => {
                            let is_admin = row.roles ? row.roles.is_admin != 0 : ''
                            return (<button-group>
                                <i-button
                                    size="small"
                                    disabled={row.roles && row.roles.is_admin !== 0}
                                    on-click={() => this.showComponent('Update', row)}
                                >修改
                                </i-button>
                                <poptip
                                    confirm
                                    transfer
                                    title="确定要删除吗？"
                                    on-on-ok={() => this.destroyItem(row, `admin/${row.id}`)}
                                >
                                    <i-button size="small" disabled={row.roles && row.roles.is_admin !== 0}>删除
                                    </i-button>
                                </poptip>
                            </button-group>)
                        }
                    }
                ]
            }
        },
        methods: {
            search (page = 1) {
                this.loading = true
                this.$http.get(`admin`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally(() => {
                    this.loading = false
                })
            }
        }
    }
</script>

<style scoped>

</style>