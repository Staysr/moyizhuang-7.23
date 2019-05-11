<template>
    <div>
        <slot></slot>
        <div class="box-flex-list">
            <Card dis-hover>
                <p slot="title">
                    <slot name="title"><span>列表</span></slot>
                    <slot name="button"></slot>
                </p>
                <my-table :columns="columns" :data="value.data" size="small" ref="table" :row-class-name="rowClassName"
                :loading="loading"></my-table>
                <Page :total="value.page.total" size="small" :current="value.page.current" :page-size="value.page.page_size" show-total @on-change="change"></Page>
            </Card>
        </div>
    </div>
</template>

<script>
    import MyTable from "../table/my-table";
    export default {
        name: "my-lists",
        components: {MyTable},
        props: {
            value: {
                type: Object,
                default: () => {return {data:[], page:{total:100, current: 1, page_size: 20}}}
            },
            columns: {
                type: Array,
                default: () => {return []}
            },
            loading: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            change(v){
                this.$emit('change', v);
            },
            rowClassName(row, index){

            }
        }
    }
</script>

<style scoped>
    .ivu-table .table-info-row td{
        background-color: #2db7f5;
        color: #fff;
    }
</style>