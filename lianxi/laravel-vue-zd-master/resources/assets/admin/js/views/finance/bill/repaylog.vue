<template>
    <component-modal title="还款记录" :width="70" >
        <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        </my-lists>
    </component-modal>
</template>

<script>

    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import component from "../../../mixins/component";
    import ComponentModal from "../../../components/modal/component-modal";
    import Box from "../../../components/box/index";

    export default {
        name: "repayLog",
        components: {MyLists,ComponentModal,Box},
        mixins: [lists,component],
        data() {
            return {
                searchForm:{
                    merchant_id:this.data.merchant_id
                },
                columns: [
                    {
                        title: '商户简称',
                        render: (h, {row}) => {
                            return <span>{row.merchant ? row.merchant.short_name : ''}</span>
                        }
                    },
                    {
                        title: '还款金额',
                        key: 'repay_money'
                    },
                    {
                        title: '创建时间',
                        key: 'create_time'
                    },
                    {
                        title: '还款方式',
                        render: (h, {row}) => {
                            return <span>还款</span>
                        }
                    },
                    {
                        title: '备注',
                        key: 'remark'
                    }
                ]
            }
        },
        methods: {
            search(page = 1){
                this.loading = true
                this.$http.get(`bill/log`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally(() => {
                    this.loading = false
                });
            }
        }
    }
</script>


