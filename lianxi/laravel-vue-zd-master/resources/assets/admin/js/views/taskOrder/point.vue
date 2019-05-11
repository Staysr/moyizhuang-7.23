<template>
    <component-modal title="创建配送点" :loading="loading" :width="850">
        <Form ref="formCreate" :model="formCreate" :label-width="100" :rules="ruleCreate">

            <FormItem label="联系人：" prop="contacts">
                <Input v-model="formCreate.contacts" placeholder="联系人"/>
            </FormItem>

            <FormItem label="联系电话：" prop="contact_way">
                <Input v-model="formCreate.contact_way" placeholder="联系电话"/>
            </FormItem>


            <FormItem label="地址：" prop="name">
                <place-search-select v-model="formCreate.name" @pois="pois" style="width: 500px"></place-search-select>
            </FormItem>

            <FormItem label="地图页面：">
            <box title="地图页面">
                <div class="amap-page-container">
                    <el-amap :center="[lng, lat]">
                        <el-amap-marker vid="component-marker" :position="[lng, lat]"></el-amap-marker>
                        <div class="long-lat-text">经度：{{lng}} ， 维度：{{lat}}</div>
                    </el-amap>
                </div>
            </box>
            </FormItem>

        </Form>

        <div slot="footer">
            <Button type="primary" :loading="loading" @click="createSubmit('formCreate', `order/point/${data.id}`)">创建</Button>
        </div>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </component-modal>

</template>
<style>
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
</style>
<script>


    import component from "../../mixins/component";
    import ComponentModal from "../../components/modal/component-modal";
    import Box from "../../components/box/index";
    import {Validator} from '../../async-validator/delivery/create'
    import form from '../../mixins/form'
    import Remote from '.././../components/select/remote'
    import lists from "../../mixins/lists";
    import PlaceSearchSelect from '../../components/map/place-search-select'

    export default {
        name: 'Create',
        components: {Remote, ComponentModal, Box, Validator,PlaceSearchSelect},
        mixins: [lists, component, form],
        data() {
            return {
                formCreate: {
                    contacts:'',
                    contact_way:'',
                    lng: 0,
                    lat: 0
                },
                ruleCreate: Validator(this)
            }
        },
        computed: {
            lng () {
                return this.formCreate.lng
            },
            lat () {
                return this.formCreate.lat
            }
        },
        methods: {
            pois (item) {
                this.formCreate.lat = item.location ? item.location.lat : 0
                this.formCreate.lng = item.location ? item.location.lng : 0
            },
            createSubmit (name, url) {
                this.$refs[name].validate((valid) => {
                    if (valid) {
                        this.loading = true
                        this.$http.post(url, this._data[name]).then((res) => {
                            this.$Message.success('Success!')
                            this.change(false)
                            this.$emit('on-ok')
                        }).catch((res) => {
                            this.formatErrors(res)
                        }).finally(() => {
                            this.loading = false
                        })
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>

