<template>
    <div>
        <div class="box-flex-list">
            <Card>
                <p slot="title">
                    <span>列表</span>
                    <Button size="small" type="success" @click="showComponent('Create')">添加</Button>
                </p>
                <TabelExpandTree :columns="columns" :data="lists" class="permission-role" :loading="loading"></TabelExpandTree>
                
                <Modal v-model="modal" width="200">
                    <p slot="header" style="color:#f60;text-align:center">
                        <Icon type="ios-information-circle"></Icon>
                        <span>删除确认</span>
                    </p>
                    <div style="text-align:center">
                        <p>确认要删除吗？</p>
                    </div>
                    <div slot="footer">
                        <Button type="error" size="default" long :loading="modal_loading" @click="del">确认</Button>
                    </div>
                </Modal>
            
            </Card>
        </div>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </div>
</template>

<script>

    import lists           from '../../../mixins/lists'
    import Create          from './create'
    import Update          from './update'
    import TabelExpandTree from '../../../components/table/tabel-expand-tree'

    export default {
        components: {
            TabelExpandTree,
            Create,
            Update
        },
        mixins: [lists],
        name: 'index',
        data () {
            return {
                id: 0,
                modal: false,
                modal_loading: false,
                columns: [
                    {
                        title: '菜单名称',
                        key: 'title',
                        render: (h, {row}) => {
                            return (<span class="table-col-title">{row.title}</span>)
                        }
                    },
                    {
                        title: '菜单路径',
                        width: 250,
                        key: 'name'
                    },
                    {
                        title: '是否菜单',
                        render: (h, {row}) => {
                            return (<span>{row.islink ? '菜单' : '权限'}</span>)
                        }
                    },
                    {
                        title: '菜单图标',
                        render: (h, {row}) => {
                            return h('Icon', {
                                attrs: {
                                    type: row.icon,
                                    size: 18
                                }
                            })
                        }
                    },
                    {
                        title: '排序',
                        key: 'sort'
                    },
                    {
                        title: '操作',
                        render: (h, {row}) => {
                            return (<button-group>
                                <i-button
                                    size="small"
                                    on-click={() => this.showComponent('Update', row)}
                                >修改
                                </i-button>
                                <i-button
                                    size="small"
                                    disabled={(this.child(row.id).length > 0)}
                                    on-click={() => {
                                        this.modal = true
                                        this.id = row.id
                                    }}
                                >删除
                                </i-button>
                            </button-group>)
                        }
                    }
                ],
                lists: []
            }
        },
        methods: {
            search (page = 1) {
                this.loading = true
                this.$http.get(`permission`).then((res) => {
                    this.lists = res.data.data
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally(() => {
                    this.loading = false
                })
            },
            child (parent) {
                return this.lists.filter(val => val.parent_id == parent)
            },
            del () {
                this.modal_loading = true
                setTimeout(() => {
                    this.modal_loading = false
                    this.modal = false
                    this.destroyItem(this.id, `permission/${this.id}`)
                }, 1000)
            }
        }
    }
</script>

<style>
    .permission-role .ivu-table-body {
        overflow-y: auto;
    }
</style>