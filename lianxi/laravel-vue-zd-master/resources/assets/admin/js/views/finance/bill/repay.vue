<template>
    <component-modal title="还款" :width="400">
        <Form :model="formUpdate" ref="formUpdate" :label-width="100" :rules="rulesUpdate">
            <FormItem label="商户简称" prop="short_name">
                {{data.merchant.short_name}}
            </FormItem>
            <FormItem label="还款金额" prop="money">
                <Input v-model="formUpdate.money" type="text"/>
            </FormItem>
            <FormItem label="备注" prop="remark">
                <Input v-model="formUpdate.remark" type="textarea"/>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" :loading="loading" @click="updateSubmit('formUpdate', `bill/repay/${data.merchant_id}`)">提交
            </Button>
        </div>
    </component-modal>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import component from "../../../mixins/component";
    import ComponentModal from "../../../components/modal/component-modal";
    import Box from "../../../components/box/index";
    import {Validator} from "../../../async-validator/bill/repay";
    import form from "../../../mixins/form";


    export default {
        name: "Repay",
        components: {MyLists, ComponentModal, Box},
        mixins: [lists, component,form],
        data() {
            this.$http.get(`bill/total/`+this.data.merchant_id).then((res) => {
                this.data.money=res.data.data;
            });
            return {
                formUpdate: {
                    money: this.data.money,
                    remark: this.data.remark
                },
                rulesUpdate: Validator(this)
            }
        }
    }
</script>

<style scoped>

</style>