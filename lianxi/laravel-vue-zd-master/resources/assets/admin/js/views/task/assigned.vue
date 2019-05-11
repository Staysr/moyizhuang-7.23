<template>
    <component-modal title="指派司机" :width="850" :loading="loading">
        <my-lists v-model="lists.data"  :columns="columns" @change="search">
            <Card>
                <p slot="title"><span>搜索</span></p>
                <Form ref="searchForm" :model="searchForm" inline :label-width="60">
                    <FormItem label="司机姓名">
                        <remote remote-url="driver/select" search-key="name" :remote="true"
                                v-model="searchForm.id"></remote>
                    </FormItem>
                    <FormItem label="司机类型">
                        <i-select v-model="searchForm.driver_type">
                            <i-option :value="0">自营司机</i-option>
                            <i-option :value="1">合作司机</i-option>
                            <i-option :value="2">社会司机</i-option>
                        </i-select>
                    </FormItem>
                    <FormItem :label-width="1">
                        <Button @click="search(1)" type="primary">搜索</Button>
                    </FormItem>
                </Form>
            </Card>

            <span slot="title">已选 （<a @click="displayChooseDrivers = true">{{chooseDrivers.length}}</a>）个司机, <a
                    @click="displayChooseDrivers = true">点击 </a>
                可查看</span>
        </my-lists>
        <div slot="footer">
            <Button type="primary" :loading="loading" @click="displayAssignedUnitPrice = true"
                    :disabled="chooseDrivers.length === 0">提交
            </Button>
        </div>
        <Modal
                v-model="displayChooseDrivers"
                title="已选司机" :width="700">
            <my-table :columns="chooseColumns" :data="chooseDrivers"></my-table>
            <div slot="footer"></div>
        </Modal>
        <Modal
                v-model="displayAssignedUnitPrice"
                title="选择价格" :width="300">
            <i-input v-model="assignedFrom.unit_price" number>
                <Icon type="logo-usd"  slot="prepend"/>
                <i-button type="primary" slot="append" @click="assigned">提交</i-button>
            </i-input>
            <div slot="footer"></div>
        </Modal>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../components/modal/component-modal";
    import MyLists from "../../components/layout/my-lists";
    import lists from "../../mixins/lists";
    import component from "../../mixins/component";
    import Remote from "../../components/select/remote";
    import MyTable from "../../components/table/my-table";
    import http from "../../mixins/http";
    export default {
        name: "assigned",
        components: {MyTable, Remote, MyLists, ComponentModal},
        mixins: [lists, component, http],
        data() {
            let col = [{
                title: '司机姓名',
                key: 'name'
            },{
                title: '手机号码',
                key: 'phone'
            },{
                title: '车牌号码',
                key: 'car_number'
            },{
                title: '城市',
                render: (h, {row}) => {
                    return <span v-show={row.category}>{row.category.name}</span>
                }
            },{
                title: '车型',
                render: (h, {row}) => {
                    return <span v-show={row.car_type}>{row.car_type.name}</span>
                }
            }];

            return {
                chooseColumns: col,
                columns: [...col, {
                    title: '操作',
                    render: (h, {row}) => {
                        return <div>
                            <i-button size="small" on-click={() => {this.choose(row)}}
                                      v-show={this.oneOf(row) === -1}>选择</i-button>
                            <i-button size="small" on-click={() => {this.cancel(row)}} v-show={this.oneOf(row)  !==
                            -1}>取消
                            </i-button>
                        </div>
                    }
                }],
                searchForm: {
                    car_type_id: this.data.car_type_ids
                },
                chooseDrivers: [],
                displayChooseDrivers: false,
                displayAssignedUnitPrice: false,
                assignedFrom:{
                    drivers: [],
                    unit_price: 0
                }
            }
        },
        methods: {
            search(page = 1){
                this.loading = true
                this.$http.get(`driver/lists`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally(() => {
                    this.loading = false
                });
            },
            choose(row){
                if(this.oneOf(row) === -1){
                    this.chooseDrivers.push(row)
                    this.assignedFrom.drivers.push(row.id)
                }
            },
            cancel(row){
                let index;
                if((index = this.oneOf(row)) !== -1){
                   this.chooseDrivers.splice(index, 1)
                    this.assignedFrom.drivers.splice(index, 1)
                }
            },
            oneOf(row){
                return this.chooseDrivers.findIndex((value, index, obj) => {
                    return value.id === row.id
                });
            },
            assigned(){
                this.loading = true
                this.$http.put(`task/assigned/${this.data.id}`, this.assignedFrom).then((res) => {
                    console.log(res)
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally(() => {
                    this.displayAssignedUnitPrice = false
                    this.loading = false
                })
            }
        }
    }
</script>

<style scoped>

</style>