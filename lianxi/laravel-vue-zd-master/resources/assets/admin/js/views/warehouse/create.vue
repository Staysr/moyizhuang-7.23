<template>
    <component-modal title="添加仓库" :width="700" :loading="loading">
        <Form ref="formCreate" :model="formCreate" :label-width="100" :rules="ruleCreate">
            <box title="仓库信息" form>
                <detail :span="12">
                    <FormItem prop="merchant_id" label="商户简称">
                        <remote remote-url="merchants/select"
                                search-key="title"
                                :remote="true"
                                v-model="formCreate.merchant_id">
                        
                        </remote>
                    </FormItem>
                </detail>
                <detail :span="12">
                    <FormItem prop="title" label="仓名称">
                        <Input v-model="formCreate.title"/>
                    </FormItem>
                </detail>
                <detail :span="12">
                    <FormItem prop="contacts" label="联系人">
                        <Input v-model="formCreate.contacts"/>
                    </FormItem>
                </detail>
                <detail :span="12">
                    <FormItem prop="contacts_phone" label="联系人手机">
                        <Input v-model="formCreate.contacts_phone"/>
                    </FormItem>
                </detail>
                <detail :span="20">
                    <FormItem prop="address" label="详细地址">
                        <place-search-select v-model="formCreate.address"
                                             @pois="pois">
                        
                        </place-search-select>
                    </FormItem>
                </detail>
                <detail :span="4" style="text-align: right;">
                    <Button size="small" @click="pushContacts">添加联系人</Button>
                </detail>
                <template v-for="(item, index) in formCreate.backup_contacts">
                    <detail :span="10">
                        <FormItem :prop="'backup_contacts.' + index+'.name'"
                                  :key="index"
                                  :rules="{type: 'string',trigger: 'blur',required: true, message:'备用联系人必须填写'}"
                                  label="备用联系人">
                            <Input v-model="item.name"/>
                        </FormItem>
                    </detail>
                    <detail :span="10">
                        <FormItem :prop="'backup_contacts.' + index +'.phone'"
                                  :key="index"
                                  :rules="{type: 'string',trigger: 'blur',required: true, message:'备用联系手机必须填写'}"
                                  label="联系手机">
                            <Input v-model="item.phone"/>
                        </FormItem>
                    </detail>
                    <detail :span="4" style="text-align: right;">
                        <Button size="small" @click="spliceContacts(index)">删除联系人
                        </Button>
                    </detail>
                </template>
                
                <detail :span="24">
                    <FormItem prop="description" style="width: 400px;" label="位置描述">
                        <Input v-model="formCreate.description" type="textarea"/>
                    </FormItem>
                </detail>
                <detail :span="24">
                    <FormItem prop="instruction" style="width: 400px;" label="行车指引">
                        <Input v-model="formCreate.instruction" type="textarea"/>
                    </FormItem>
                </detail>
                <detail :span="24">
                    <FormItem prop="remark" style="width: 400px;" label="备注">
                        <Input v-model="formCreate.remark" type="textarea"/>
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
            <Button type="primary" :loading="loading" @click="createSubmit('formCreate', 'warehouse')">创建</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal    from '../../components/modal/component-modal'
    import component         from '../../mixins/component'
    import Box               from '../../components/box/index'
    import Detail            from '../../components/detail/index'
    import PlaceSearchSelect from '../../components/map/place-search-select'
    import { Validator }     from '../../async-validator/warehouse/create'
    import form              from '../../mixins/form'
    import Remote            from '../../components/select/remote'

    export default {
        name: 'Create',
        components: {Remote, PlaceSearchSelect, Detail, Box, ComponentModal},
        mixins: [component, form],
        data () {
            return {
                formCreate: {
                    longitude: 0,
                    latitude: 0,
                    backup_contacts: []
                },
                ruleCreate: Validator(this)
            }
        },
        computed: {
            longitude () {
                return this.formCreate.longitude
            },
            latitude () {
                return this.formCreate.latitude
            }
        },
        methods: {
            pois (item) {
                this.formCreate.latitude = item.location ? item.location.lat : 0
                this.formCreate.longitude = item.location ? item.location.lng : 0
                this.formCreate.description = item.address || ''
                this.formCreate.category_zone = (item.pname || '') + ' ' + (item.cityname || '') + ' ' + (item.adname
                    || '')
            },
            spliceContacts (index) {
                this.formCreate.backup_contacts.splice(index, 1)
            },
            pushContacts () {
                this.formCreate.backup_contacts.push({
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
    .ivu-form .box-detail {
        /*margin-bottom: 20px;*/
    }
    
    .amap-page-container {
        height: 400px;
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
    
    .checkbox-button-all {
        vertical-align: middle;
        display: inline-block;
        height: 32px;
        line-height: 30px;
        margin: 0;
        padding: 0 15px;
        font-size: 12px;
        color: #515a6e;
        transition: all .2s ease-in-out;
        cursor: pointer;
        border: 1px solid #dcdee2;
        background: #fff;
        position: relative;
        border-radius: 4px;
    }
    
    .checkbox-button-all-checked {
        border-color: #2d8cf0;
        color: #2d8cf0;
    }

</style>