<template>
    <component-modal title="修改保险" :loading="loading">
        <Form ref="formUpdate" :model="formUpdate" :label-width="100" :rules="ruleUpdate">

            <FormItem label="商户简称">
                <Input v-model="formUpdate.merchant.short_name" style="width: 200px" disabled  />
            </FormItem>

            <FormItem label="出车单号：" >
                <Input v-model="formUpdate.order_id"
                       icon="ios-clock-outline" style="width: 200px" disabled  />
            </FormItem>


            <FormItem label="类型：" prop="type" >
                <RadioGroup v-model="formUpdate.type" type="button">
                    <Radio :label="1" :value="1">奖励</Radio>
                    <Radio :label="2" :value="2">罚款</Radio>
                    <Radio :label="3" :value="3">其他</Radio>
                </RadioGroup>
            </FormItem>


            <FormItem label="金额：" prop="fee">
                <Input v-model="formUpdate.fee" placeholder="金额" style="width: 300px"/>
            </FormItem>

            <FormItem label="原因：" prop="reason">
                <Input type="textarea" v-model="formUpdate.reason" placeholder="原因" style="width: 300px"/>
            </FormItem>

        </Form>
        <div slot="footer">
            <Button type="primary" :loading="loading"
                    @click="updateSubmit('formUpdate', `award/${data.id}`)">修改</Button>
        </div>
    </component-modal>
</template>

<script>


    import component from "../../../mixins/component";
    import ComponentModal from "../../../components/modal/component-modal";
    import Box from "../../../components/box/index";
    import {Validator} from '../../../async-validator/award/update'
    import form from '../../../mixins/form'
    import Remote from '../../../components/select/remote'
    import lists from "../../../mixins/lists";

    export default {
        name: 'Update',
        components: {Remote, ComponentModal, Box, Validator},
        mixins: [ lists,component, form],
        data() {
            return {
                formUpdate: {
                    merchant:{
                        short_name:''
                    },
                    merchant_id: 0,
                    order_id: '',
                    type: 0,
                    fee: 0,
                    reason: '',
                },
                ruleUpdate: Validator(this)
            }
        },
        computed: {},
        methods: {},
        mounted(){
            this.loading = true;
            this.$http.get(`award/${this.data.id}`).then((res) => {
                this.formUpdate = res.data.data
            }).finally(() => {
                this.loading = false
            })
        },
    }
</script>

<style scoped>

</style>

