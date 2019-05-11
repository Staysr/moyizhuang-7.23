<template>
    <component-modal title="购买保价" :width="800">
        <Form :model="formUpdate" ref="formUpdate" :label-width="100" :rules="rulesUpdate">

            <FormItem label="保价服务" prop="merchant_safe_id">
                <group-radio url="safe/select" v-model="formUpdate.merchant_safe_id"></group-radio>

                <br/>选择方舟保价服务，为您的货物保驾护航,服务将在司机签到时生效
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" :loading="loading" @click="updateSubmit('formUpdate', `task/safe/${data.id}`)">提交
            </Button>
        </div>
    </component-modal>
</template>

<script>
    import MyLists from "../../components/layout/my-lists";
    import lists from "../../mixins/lists";
    import component from "../../mixins/component";
    import ComponentModal from "../../components/modal/component-modal";
    import Box from "../../components/box/index";
    import {Validator} from "../../async-validator/task/safe";
    import form from "../../mixins/form";
    import GroupRadio  from '../../components/radio/group-radio'


    export default {
        name: "safe",
        components: {MyLists, ComponentModal, Box,GroupRadio},
        mixins: [lists, component,form],
        data() {
            return {
                formUpdate: {
                    merchant_safe_id:this.data.merchant_safe_id
                },
                rulesUpdate: Validator(this)
            }
        }
    }
</script>

<style scoped>

</style>