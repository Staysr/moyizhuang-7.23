<template>
    <component-modal title="查看仓库" :loading="loading">
        <box title="仓库信息" >
            <detail title="商户简称" :span="12">{{row.merchant ? row.merchant.short_name : ''}}</detail>
            <detail title="仓名称" :span="12">{{row.title}}</detail>
            <detail title="联系人" :span="12">{{row.contacts}}</detail>
            <detail title="联系人手机" :span="12">{{row.contacts_phone}}</detail>
            <template v-for="(item, index) in row.backup_contacts">
                <detail title="备用联系人" :span="12">{{item.name}}</detail>
                <detail title="备用联系手机" :span="12">{{item.phone}}</detail>
            </template>
            <detail title="详细地址" :span="24">{{row.address}}</detail>
            <detail title="位置描述"  :span="24">{{row.description}}</detail>
            <detail title="行车指引"  :span="24">{{row.instruction}}</detail>
            <detail title="备注" :span="24">{{row.remark}}</detail>
        </box>

        <box title="仓库地图">
            <div class="amap-page-container">
                <el-amap :center="position">
                    <el-amap-marker vid="component-marker" :position="position"></el-amap-marker>
                </el-amap>
            </div>
        </box>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../components/modal/component-modal";
    import component from "../../mixins/component";
    import Box from "../../components/box/index";
    import Detail from "../../components/detail/index";

    export default {
        name: "mview",
        components: {Detail, Box, ComponentModal},
        mixins: [component],
        data() {
            return {
                row: {}
            }
        },
        computed:{
            position() {
                return [
                    this.row && this.row.longitude? this.row.longitude : 0,
                    this.row && this.row.latitude ? this.row.latitude : 0
                ];
            }
        },
        mounted(){
            this.loading = true
            this.$http.get(`warehouse/${this.data.id}`).then((res) => {
                this.row = res.data.data
            }).finally(() => {
                this.loading = false
            })
        }
    }
</script>

<style scoped>
    .amap-page-container{
        height: 200px;
    }
</style>