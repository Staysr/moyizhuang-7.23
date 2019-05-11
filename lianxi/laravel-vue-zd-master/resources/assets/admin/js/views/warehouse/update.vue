<template>
    <component-modal title="查看仓库" :width="700" :loading="loading">
        <Form ref="formUpdate" :model="formUpdate" :label-width="90" :rules="ruleUpdate">
            <box title="仓库信息" form>
                <detail :span="12">
                    <FormItem prop="merchant_id" label="商户简称">
                        <Tag type="border" v-if="formUpdate.merchant" closable
                             @on-close="formUpdate.merchant = null">{{formUpdate.merchant
                            .short_name}}</Tag>
                        <remote remote-url="merchants/select" search-key="title" :remote="true"
                                v-model="formUpdate.merchant_id" v-else></remote>
                    </FormItem>
                </detail>
                <detail :span="12">
                    <FormItem prop="title" label="仓名称">
                        <Input v-model="formUpdate.title"></Input>
                    </FormItem>
                </detail>
                <detail :span="12">
                    <FormItem prop="contacts" label="联系人">
                        <Input v-model="formUpdate.contacts"></Input>
                    </FormItem>
                </detail>
                <detail :span="12">
                    <FormItem prop="contacts_phone" label="联系人手机">
                        <Input v-model="formUpdate.contacts_phone"></Input>
                    </FormItem>
                </detail>
                <detail :span="20">
                    <FormItem prop="address" label="详细地址">
                        <place-search-select v-model="formUpdate.address" style="width: 400px;"
                                             @pois="pois"></place-search-select>
                    </FormItem>
                </detail>
                <detail :span="4" style="text-align: right;">
                    <Button size="small" @click="pushContacts">添加联系人</Button>
                </detail>
                <template v-for="(item, index) in formUpdate.backup_contacts">
                    <detail :span="10">
                        <FormItem :prop="'backup_contacts.' + index+'.name'"
                                  :key="index"
                                  :rules="{type: 'string',trigger: 'blur',required: true, message:'备用联系人必须填写'}"
                                  label="备用联系人">
                            <Input v-model="item.name"></Input>
                        </FormItem>
                    </detail>
                    <detail :span="10">
                        <FormItem :prop="'backup_contacts.' + index +'.phone'"
                                  :key="index"
                                  :rules="{type: 'string',trigger: 'blur',required: true, message:'备用联系手机必须填写'}"
                                  label="联系手机">
                            <Input v-model="item.phone"></Input>
                        </FormItem>
                    </detail>
                    <detail :span="4" style="text-align: right;">
                        <Button size="small" @click="spliceContacts(index)">删除联系人
                        </Button>
                    </detail>
                </template>
                <detail :span="24">
                    <FormItem prop="description" style="width: 400px;" label="位置描述">
                        <Input v-model="formUpdate.description" type="textarea"></Input>
                    </FormItem>
                </detail>
                <detail :span="24">
                    <FormItem prop="instruction" style="width: 400px;" label="行车指引">
                        <Input v-model="formUpdate.instruction" type="textarea"></Input>
                    </FormItem>
                </detail>
                <detail :span="24">
                    <FormItem prop="remark" style="width: 400px;" label="备注">
                        <Input v-model="formUpdate.remark" type="textarea"></Input>
                    </FormItem>
                </detail>
            </box>

            <box title="地图页面">
                <div class="amap-page-container">
                    <el-amap :center="[longitude, latitude]">
                        <el-amap-marker vid="component-marker" :position="[longitude, latitude]"></el-amap-marker>
                        <div class="long-lat-text">经度：{{longitude}} ， 维度：{{latitude}}</div>
                    </el-amap>
                </div>
            </box>
        </Form>
        <div slot="footer">
            <Button type="primary" :loading="loading"
                    @click="updateSubmit('formUpdate', `warehouse/${data.id}`)">更新</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../components/modal/component-modal";
    import component from "../../mixins/component";
    import Box from "../../components/box/index";
    import Detail from "../../components/detail/index";
    import PlaceSearchSelect from "../../components/map/place-search-select";
    import {Validator} from '../../async-validator/warehouse/update';
    import form from "../../mixins/form";
    import Remote from "../../components/select/remote";

    export default {
        name: "Update",
        components: {Remote, PlaceSearchSelect, Detail, Box, ComponentModal},
        mixins: [component, form],
        data() {
            return {
                formUpdate: {
                    longitude: 0,
                    latitude: 0,
                    backup_contacts:[]
                },
                ruleUpdate: Validator(this)
            }
        },
        computed: {
            longitude() {
                return this.formUpdate.longitude
            },
            latitude() {
                return this.formUpdate.latitude
            }
        },
        mounted(){
            this.loading = true
            this.$http.get(`warehouse/${this.data.id}`).then((res) => {
                this.formUpdate = res.data.data
            }).finally(() => {
                this.loading = false
            })
        },
        methods: {
            pois(item) {
                this.formUpdate.latitude = item.location ? item.location.lat : 0
                this.formUpdate.longitude = item.location ? item.location.lng : 0
                this.formUpdate.description = item.address || ''
                this.formUpdate.category_zone = (item.pname || '') + ' ' +  (item.cityname || '') + ' ' +  (item.adname
                    || '')
            },
            spliceContacts(index){
                this.formUpdate.backup_contacts.splice(index, 1);
            },
            pushContacts(){
                this.formUpdate.backup_contacts.push({
                    name: '',
                    phone: ''
                })
            }
        }
    }
</script>

<style scoped>
    .amap-page-container {
        height: 190px;
        position: relative;
    }

    .long-lat-text {
        background-color: #ffffff;
        border: 1px #c0c0c0 solid;
        padding: 2px;
        position: absolute;
        top: 10px;
        right: 10px;
        border-radius: 6px;
    }
</style>

<style>
   .ivu-form  .box-detail{
        margin-bottom: 20px;
    }

</style>