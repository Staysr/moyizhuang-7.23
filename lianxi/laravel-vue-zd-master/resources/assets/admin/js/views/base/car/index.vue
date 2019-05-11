<template>
    <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title"><span>搜索</span></p>
            <Form ref="searchForm" :model="searchForm" inline  :label-width="60">
                <FormItem label="外包公司">
                    <remote remote-url="company/select" :remote="false" :ready="true"
                            v-model="searchForm.company_id"></remote>
                </FormItem>
                <FormItem prop="driver_id" label="司机姓名">
                    <remote
                            remote-url="driver/select"
                            v-model="searchForm.driver_id"
                            :remote="true"
                            :ready="false"
                            :params="{company_id: this.searchForm.company_id}"
                    ></remote>
                </FormItem>
                <FormItem label="车牌号码">
                    <Input v-model="searchForm.number"></Input>
                </FormItem>
                <FormItem label="创建时间" :label-width="60">
                    <c-date-picker type="daterange" v-model="searchForm.created_at"></c-date-picker>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="download()" type="primary">导出</Button>
                </FormItem>
            </Form>
        </Card>
    </my-lists>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import CDatePicker from "../../../components/date-picker/index";
    import Remote from "../../../components/select/remote";
    export default {
        name: "index",
        components: {Remote, CDatePicker, MyLists},
        mixins: [lists],
        data() {
            return {
                columns: [{
                    title: '车牌号码',
                    key: 'number'
                }, {
                    title: '关联司机',
                    render: (h, {row}) => {
                        return <span>{row.driver ? row.driver.name : ''}</span>
                    }
                }, {
                    title: '司机号码',
                    render: (h, {row}) => {
                        return <span>{row.driver ? row.driver.phone : ''}</span>
                    }
                }, {
                    title: '车辆型号',
                    render: (h, {row}) => {
                        return <span>{row.car_type.name}</span>
                    }
                }, {
                    title: '外包公司',
                    render: (h, {row}) => {
                        return <span>{row.company.name}</span>
                    }
                }, {
                    title: '车辆配件',
                    key: 'parts'
                }, {
                    title: '创建时间',
                    key: 'created_at'
                }]
            }
        },
        methods: {
            search(page = 1){
                this.loading = true
                this.$http.get(`car/index`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally(() => {
                    this.loading = false
                });
            },
            download() {
                this.$http.download(`car/export`, this.request(), '车辆列表.xls');
            }
        }
    }
</script>

<style scoped>

</style>