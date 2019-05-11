<template>
    <ExcelUpload action="time/import" url="time/template" file-name="配送点导入" :max-cells="600" :title-header="headers" :columns="columns" v-on:visibleChange="visibleChange"></ExcelUpload>
</template>

<script>
    import ExcelUpload from '../../components/upload/excel-upload'
    export default {
        name: "import",
        components: {
            ExcelUpload
        },
        data() {
            return {
                headers: [
                    'date', 'merchant_id', 'merchant_name', 'warehouse_id', 'warehouse_name', 'contacts', 'contact_way', 'province', 'city', 'district', 'address', 'remark'
                ],
                columns: [
                    {title: '到仓时间', key: 'date'},
                    {title: '商户ID', key: 'merchant_id'},
                    {title: '商户简称', key: 'merchant_name'},
                    {title: '仓库ID', key: 'warehouse_id'},
                    {title: '仓库名称', key: 'warehouse_name'},
                    {title: '联系人', key: 'contacts'},
                    {title: '联系电话', key: 'contact_way'},
                    {title: '省份', key: 'province'},
                    {title: '城市', key: 'city'},
                    {title: '地区', key: 'district'},
                    {title: '收货地址', key: 'address'},
                    {title: '备注', key: 'remark'},
                ]
            }
        },
        methods: {
            visibleChange(visible) {
                if (visible === false) {
                    this.$emit('visibleChange', visible)
                }
            },
        }
    }
</script>

<style scoped>

</style>