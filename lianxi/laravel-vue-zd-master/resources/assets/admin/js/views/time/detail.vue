<template>
    <component-modal title="修改位置" :width="900">
        <box title="当前定位">
            <Form ref="row" :model="row" :label-width="80" :rules="ruleUpdate">
                <FormItem label="导入地址:" prop="name">
                    <Input v-model="row.name" :readonly="true" />
                </FormItem>

                <FormItem label="定位地址:" prop="fixed_name">
                    <place-search-input v-model="row.fixed_name" style="width:100%;"
                                         @pois="pois"></place-search-input>
                </FormItem>
            </Form>
        </box>

        <box title="地图定位">
            <div class="amap-page-container">
                <el-amap :center="position" :events="events">
                    <el-amap-marker vid="amap"  :position="position"></el-amap-marker>
                </el-amap>
            </div>
        </box>

        <div slot="footer">
            <Button type="primary" :loading="loading" @click="updateSubmit('row', `point/${row.id}`)">保存</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../components/modal/component-modal";
    import PlaceSearchInput from "../../components/map/place-search-input";
    import Detail from "../../components/detail/index";
    import component from "../../mixins/component";
    import form from "../../mixins/form";
    import Box from "../../components/box/index";
    import {Validator} from "../../async-validator/point/update";

    export default {
        name: "point-detail",
        components: {Detail, ComponentModal, Box, PlaceSearchInput},
        mixins: [component, form],
        data() {
            let self = this;
            return {
                row: {},
                ruleUpdate: Validator(this),
                positions: {
                    lng: '',
                    lat: '',
                    address: '',
                    loaded: false
                },
                center: [121.59996, 31.197646],
                events:{
                    click: (e) => {
                        AMap.plugin('AMap.Geocoder', () => {
                            let geocoder = new AMap.Geocoder({
                                city: '010'
                            })
                            geocoder.getAddress(e.lnglat, (status, result) => {
                                if (status === 'complete' && result.info === 'OK') {
                                    this.row.fixed_name = result.regeocode.formattedAddress;
                                    this.row.lat = e.lnglat.lat;
                                    this.row.lng = e.lnglat.lng
                                }
                            })
                        })
                    }
                }
            }
        },
        computed:{
            position() {
                return [
                    this.row && this.row.lng? this.row.lng : 0,
                    this.row && this.row.lat ? this.row.lat : 0
                ];
            }
        },
        mounted(){
            this.$http.get(`point/show/${this.data.id}`).then((res) => {
                this.row = res.data.data
            })
        },
        methods: {
            pois(item){console.log(item);
                this.row.lng = item.location ? item.location.lng : 0;
                this.row.lat = item.location ? item.location.lat : 0;
                this.row.fixed_name = (item.pname || '') + (item.cityname || '') + (item.adname || '') + (item.name || '');
            }
        }

    }
</script>

<style scoped>
    .amap-page-container {
        height: 400px;
    }
</style>