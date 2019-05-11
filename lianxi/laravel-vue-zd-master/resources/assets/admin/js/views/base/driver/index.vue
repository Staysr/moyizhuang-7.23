<template>
    <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title"><span>搜索</span></p>
            <Form ref="searchForm" :model="searchForm" inline>
                <FormItem prop="name" label="司机姓名" :label-width="60">
                    <Input type="text" v-model="searchForm.name"></Input>
                </FormItem>
                <FormItem prop="phone" label="手机号" :label-width="60">
                    <Input type="text" v-model="searchForm.phone"></Input>
                </FormItem>
                <FormItem prop="car_number" label="车牌号" :label-width="60">
                    <Input type="text" v-model="searchForm.car_number"></Input>
                </FormItem>
                <FormItem prop="assess_score" label="评分" :label-width="60" :rules="rules.assess_score">
                    <number-range v-model="searchForm.assess_score"></number-range>
                </FormItem>
                <FormItem prop="company_id" label="外包公司" :label-width="60">
                    <remote remote-url="company/select"
                            :ready="true"
                            :remote="false"
                            v-model="searchForm.company_id">
                    
                    </remote>
                </FormItem>
                <FormItem prop="type" label="角色" :label-width="60">
                    <driver-type v-model="searchForm.type"></driver-type>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="download()" type="primary">导出</Button>
                </FormItem>
            </Form>
        </Card>
        
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </my-lists>
</template>

<script>

    import MyLists     from '../../../components/layout/my-lists'
    import lists       from '../../../mixins/lists'
    import mView       from './index-view'
    import DriverType  from '../../components/driver-type/index'
    import Remote      from '../../../components/select/remote'
    import NumberRange from '../../../components/input/number-range'

    export default {
        components: {
            NumberRange,
            Remote,
            DriverType,
            MyLists, mView
        },
        mixins: [lists],
        name: 'index',
        data () {
            return {
                searchForm: {
                    assess_score: {}
                },
                rules: {
                    assess_score: {
                        validator: (rule, value, callback) => {
                            if (value.min || value.max || value.min === 0 || value.max === 0) {
                                if (/^\d+(\.\d{1,2})?$/.test(value.min) && value.min <= 5) {
                                    if (/^[1-9]\d*(\.\d{1,2})?$/.test(value.max) && value.max <= 5) {
                                        if (value.min <= value.max) {
                                            callback()
                                        } else {
                                            callback(new Error('最小值须小于等于最大值'))
                                        }
                                    } else {
                                        callback(new Error('请输入有效最大值'))
                                    }
                                } else {
                                    callback(new Error('请输入有效最小值'))
                                }
                            } else {
                                callback()
                            }
                        },
                        trigger: 'blur'
                    }
                },
                columns: [
                    {
                        title: '司机姓名',
                        key: 'name'
                    }, {
                        title: '手机号',
                        key: 'phone'
                    }, {
                        title: '身份证',
                        key: 'idcard'
                    }, {
                        title: '城市',
                        render: (h, {row}) => {
                            return <span>{row.category ? row.category.name : ''}</span>
                        }
                    }, {
                        title: '角色',
                        render: (h, {row}) => {
                            switch (row.type) {
                                case 0:
                                    return <span>队员</span>
                                    break
                                case 1:
                                    return <span>小队长</span>
                                    break
                                case 2:
                                    return <span>大队长</span>
                                    break
                            }
                        }
                    }, {
                        title: '外包公司',
                        render: (h, {row}) => {
                            return <span>{row.company ? row.company.name : ''}</span>
                        }
                    }, {
                        title: '所属上级',
                        render: (h, {row}) => {
                            return <span>{row.supervisor ? row.supervisor.name : ''}</span>
                        }
                    }, {
                        title: '车牌号码',
                        key: 'car_number'
                    }, {
                        title: 'APP状态',
                        render: (h, {row}) => {
                            if (row.app_status === 1)
                                return <span>在职</span>
                            else
                                return <span>离职</span>
                        }
                    }, {
                        title: '车型',
                        render: (h, {row}) => {
                            return <span>{row.car_type ? row.car_type.name : ''}</span>
                        }
                    }, {
                        title: '成功配送次数',
                        render: (h, {row}) => {
                            return <span>{row.driver_sub ? row.driver_sub.complete_count : 0}</span>
                        }
                    }, {
                        title: '上岗次数',
                        render: (h, {row}) => {
                            return <span>{row.driver_sub ? row.driver_sub.work_count : 0}</span>
                        }
                    }, {
                        title: '投诉次数',
                        render: (h, {row}) => {
                            return <span>{row.driver_sub ? row.driver_sub.complaint_count : 0}</span>
                        }
                    }, {
                        title: '评分',
                        render: (h, {row}) => {
                            return <span>{row.assess_score ? row.assess_score : 5}</span>
                        }
                    }, {
                        title: '操作',
                        render: (h, {row}) => {
                            return <i-button on-click={() => this.showComponent('mView', row)}
                                             size="small">详情</i-button>
                        }
                    }
                ]
            }
        },
        methods: {
            search (page = 1) {
                this.$refs['searchForm'].validate((valid) => {
                    if (valid) {
                        this.loading = true
                        this.$http.get(`driver/index`, {params: this.request(page)}).then((res) => {
                            this.assignmentData(res.data.data)
                        }).finally(() => {
                            this.loading = false
                        })
                    }
                })
            },
            download () {
                this.$http.download(`driver/export/self`, this.request(), '自营司机列表.xls')
            }
        }
    }
</script>

<style>

</style>