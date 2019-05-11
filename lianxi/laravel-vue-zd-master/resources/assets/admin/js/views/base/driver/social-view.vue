<template>
    <component-modal title="详情" :width="750" :loading="loading">
        <box title="详细信息">
            <detail title="司机姓名">{{driver.name}}</detail>
            <detail title="性别">{{driver.sex ? '女' : '男'}}</detail>
            <detail title="籍贯">{{driver.native_place}}</detail>
            <detail title="手机号">{{driver.phone}}</detail>
            <detail title="身份证号">{{driver.idcard}}</detail>
            <detail title="联系地址">{{driver.address}}</detail>
            <detail title="工号">{{driver.job_number}}</detail>
            <detail title="工龄">{{driver.entry_time | formatDate}}</detail>
            <detail title="驾照等级">{{driver.drive_level}}</detail>
            <detail title="驾龄">{{driver.job_date | formatDate}}</detail>
            <detail title="商圈车队"><span v-if="driver.category">{{driver.category.name}}</span></detail>
            <detail title="入职时间">{{driver.entry_time}}</detail>
            <detail title="分配车辆">{{driver.car_number}}</detail>
            <detail title="车型"><span v-if="driver.car_type">{{driver.car_type.name}}</span></detail>
            <detail title="创建时间">{{driver.create_time}}</detail>
            <detail title="APP状态">{{driver.app_status ? '在职' : '离职'}}</detail>
            <detail title="收车状态">{{driver.is_work === 0 && driver.is_big_work === 0 ? '收车': '出车'}}</detail>
            <detail title="空闲状态">{{driver.is_big_work === 0 && driver.work_status === 0 ? '空闲' : '运单'}}</detail>
        </box>
        <box title="证件信息" v-if="driver.review">
            <detail :span="6" v-for="(item,index) in driver.review" :key="index" :title="item.remark">
                <box-image :src="item.value" :size="100"></box-image>
            </detail>
        </box>
    </component-modal>
</template>

<script>
    import moment from '../../../plugins/moment/moment-with-zh-min'
    import ComponentModal from '../../../components/modal/component-modal'
    import component from '../../../mixins/component'
    import Box from "../../../components/box/index";
    import Detail from "../../../components/detail/index";
    import form from "../../../mixins/form";
    import XImg from "vux/src/components/x-img/index";
    import boxImage from "../../../components/image/index";

    export default {
        name: "m-view",
        components: {
            boxImage,
            XImg,
            Box,
            ComponentModal,
            Detail
        },
        data() {
            return {
                driver: {}
            }
        },
        mixins: [component, form],
        mounted() {
            this.$nextTick(() => {
                this.$http.get(`driver/social/${this.data.id}`).then((res) => {
                    this.driver = Object.assign(this.unObserver(this.driver), res.data.data)
                }).catch((err) => {
                    this.formatErrors(err)
                })
            })
        },
        filters: {
            formatDate(v){
                return v ? moment().to(v) : ''
            }
        }
    }
</script>

<style scoped>

</style>