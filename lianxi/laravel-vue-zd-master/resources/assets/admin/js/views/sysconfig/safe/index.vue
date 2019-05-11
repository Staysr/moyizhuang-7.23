<template>
    <my-lists v-model="lists.data" :columns="columns" :loading="loading">
        <p slot="title">
            <span>列表</span>
            <Button size="small" type="success" @click="showComponent('Create')">添加</Button>
        </p>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </my-lists>
</template>

<script>
    import MyLists from '../../../components/layout/my-lists'
    import lists   from '../../../mixins/lists'
    import Create  from './create'

    export default {
        components: {MyLists, Create},
        mixins: [lists],
        name: 'index',
        data () {
            return {
                columns: [
                    {
                        title: '保险类型',
                        render: (h, {row}) => {
                            return (<span>{row.type === 1 ? '商户险' : '司机险'}</span>)
                        }
                    },
                    {
                        title: '保险名称',
                        key: 'title'
                    },
                    {
                        title: '保障服务费',
                        render: (h, {row}) => {
                            return (<span>{row.safe_fee}元</span>)
                        }
                    },
                    {
                        title: '最高赔付',
                        render: (h, {row}) => {
                            return (<span>{row.max_payment}万元</span>)
                        }
                    },
                    {
                        title: '状态',
                        render: (h, {row}) => {
                            return (row.status === 1 ? <span>启用</span> : <span style="color:red">禁用</span>)
                        }
                    },
                    {
                        title: '操作',
                        render: (h, {row}) => {
                            return (<button-group>
                                <poptip
                                    confirm
                                    transfer
                                    title="确定要切换状态吗？"
                                    on-on-ok={() => this.cutoverStatus(row, `safe/${row.id}/status`)}
                                >
                                    {row.status === 1 ? <i-button size="small">禁用</i-button> :
                                        <i-button type="primary" size="small">启用</i-button>}
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
                this.$http.get(`safe/index`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally(() => {
                    this.loading = false
                })
            },
            cutoverStatus (row, url) {
                this.$http.put(url, {status: row.status === 1 ? 0 : 1}).then((res) => {
                    this.$Message.success(res.data.message)
                    this.search()
                }).catch((res) => {
                    this.formatErrors(res)
                })
            }
        }
    }
</script>

<style scoped>

</style>