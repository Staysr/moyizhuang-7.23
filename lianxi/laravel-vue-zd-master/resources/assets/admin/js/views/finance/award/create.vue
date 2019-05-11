<template>
    <component-modal title="创建保险" :loading="loading" :width="850">
        <Form ref="formCreate" :model="formCreate" :label-width="100" :rules="ruleCreate">

            <FormItem label="商户简称" prop="merchant_id">
                <remote remote-url="merchants/select" search-key="title" :remote="true"
                        v-model="formCreate.merchant_id"></remote>
            </FormItem>

            <FormItem label="出车单ID：" prop="order_no">
                <Input v-model="formCreate.order_no" placeholder="出车单编号" style="width: 300px" readonly=""/>
                <Icon type="ios-search" style="width: 200px" @click.native="showComponent('Order')"></Icon>
            </FormItem>

            <FormItem label="出车单ID：" prop="order_id" style="display: none">
                <Input v-model="formCreate.order_id" placeholder="出车单ID" />
            </FormItem>

            <FormItem label="类型：" prop="type" >
                <RadioGroup v-model="formCreate.type" type="button">
                    <Radio :label="1" :value="1">奖励</Radio>
                    <Radio :label="2" :value="2">罚款</Radio>
                    <Radio :label="3" :value="3">其他</Radio>
                </RadioGroup>
            </FormItem>

            <FormItem label="金额：" prop="fee">
                <Input v-model="formCreate.fee" placeholder="金额" style="width: 300px"/>
            </FormItem>

            <FormItem label="原因：" prop="reason">
                <Input type="textarea" v-model="formCreate.reason" placeholder="原因" style="width: 300px"/>
            </FormItem>
        </Form>

        <div slot="footer">
            <Button type="primary" :loading="loading" @click="createSubmit('formCreate', 'award')">创建</Button>
        </div>
        <components v-bind:is="component.current" @on-change="change" :data="component.data"></components>
    </component-modal>

</template>

<script>


    import component from "../../../mixins/component";
    import ComponentModal from "../../../components/modal/component-modal";
    import Box from "../../../components/box/index";
    import {Validator} from '../../../async-validator/award/create'
    import form from '../../../mixins/form'
    import Remote from '../../../components/select/remote'
    import lists from "../../../mixins/lists";
    import Order from "./Order";
    import AwardStatus from "../../components/award/status";

    export default {
        name: 'Create',
        components: {AwardStatus, Remote, ComponentModal, Box, Validator, Order},
        mixins: [lists, component, form],
        data() {
            return {
                formCreate: {},
                ruleCreate: Validator(this)
            }
        },
        computed: {},
        methods: {
            change(row) {
                this.hideComponent()
                this.formCreate.order_id=row.id;
                this.formCreate.order_no=row.order_no;
            },

        }
    }
</script>

<style scoped>

</style>

