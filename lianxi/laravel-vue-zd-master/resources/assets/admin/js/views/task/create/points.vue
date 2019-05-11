<template>
    <component-modal title="导入配送点信息" :width="50">
        <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
            <Card>
                <p slot="title"><span>搜索</span></p>
                <Form ref="searchForm" :model="searchForm" inline :label-width="60">
                    <FormItem label="到仓时间">
                        <c-date-picker v-model="searchForm.arrival_time"
                                       :options="options"
                                       type="datetimerange"
                                       :panels="true"
                                       style="width: 300px">
                        
                        </c-date-picker>
                    </FormItem>
                    <FormItem :label-width="1">
                        <Button @click="search(1)" type="primary">搜索</Button>
                    </FormItem>
                </Form>
            </Card>
        </my-lists>
    </component-modal>
</template>

<script>

    import MyLists        from '../../../components/layout/my-lists'
    import lists          from '../../../mixins/lists'
    import component      from '../../../mixins/component'
    import ComponentModal from '../../../components/modal/component-modal'
    import CDatePicker    from '../../../components/date-picker/index'

    export default {
        name: 'points',
        components: {
            MyLists,
            ComponentModal,
            CDatePicker
        },
        mixins: [lists, component],
        data () {
            return {
                options: {},
                extra: {
                    total: []
                },
                columns: [
                    {
                        title: '线路名称',
                        render: (h, {row}) => {
                            return <span>{row.title}</span>
                        }
                    },
                    {
                        title: '到仓时间',
                        render: (h, {row}) => {
                            return <span>{row.arrival_warehouse_day + ' ' + row.arrival_warehouse_time}</span>
                        }
                    },
                    {
                        title: '操作',
                        render: (h, {row}) => {
                            return (<button-group>
                                <i-button
                                    size="small"
                                    on-click={() => this.import(row.id)}>指定
                                </i-button>
                            </button-group>)
                        }
                    }
                ]
            }
        },
        computed: {
            total () {
                return this.extra.total
            }
        },
        methods: {
            search (page = 1) {
                this.loading = true
                this.$http.get(`point/taskline/${this.data}`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally(() => {
                    this.loading = false
                })
            },
            import (id) {
                this.loading = true
                this.$http.get(`point/tasklinepoint/${id}`).then((res) => {
                    if (res.data.data.length > 0) {
                        this.$emit('points', res.data.data)
                    }
                    this.change(false)
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally(() => {
                    this.loading = false
                })
            }
        }
    }
</script>


