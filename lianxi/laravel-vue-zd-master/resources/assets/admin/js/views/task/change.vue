<template>
    <component-modal title="改派司机" :width="850" :loading="loading">
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
        </my-lists>
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
    export default {
        name: "assigned",
        components: {MyTable, Remote, MyLists, ComponentModal},
        mixins: [lists, component],
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
                            <i-button size="small" on-click={() => {this.choose(row)}} >选择</i-button>
                        </div>
                    }
                }],
                searchForm: {
                    car_type_id: this.data.car_type_ids,
                    n_id: this.data.driver_id,
                },
                chooseDrivers: [],
                displayChooseDrivers: false,
                displayAssignedUnitPrice: false,
                assignedFrom:{
                    driver_id: 0,
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
                    this.assignedFrom.driver_id=row.id
                    this.displayAssignedUnitPrice=true;
            },
            assigned(){
                this.loading = true
                this.$http.put(`task/change/${this.data.id}`, this.assignedFrom).then((res) => {
                    console.log(res)
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