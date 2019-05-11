<template>
    <component-modal title="代签到" :width="350" :loading="loading">
        <Form :model="formUpdate" ref="formUpdate" :label-width="50" :rules="rulesUpdate">
            <FormItem label="备注" prop="remark">
                <Input v-model="formUpdate.remark" type="textarea"/>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" :loading="loading" @click="updateSubmit('formUpdate', `order/agent/${data.id}`)">提交</Button>
        </div>
    </component-modal>
</template>

<script>
    import component from "../../mixins/component";
    import ComponentModal from "../../components/modal/component-modal";
    import {Validator} from "../../async-validator/taskOrder/agent"
    import form from "../../mixins/form";


    export default {
        name: "agent",
        components: {ComponentModal},
        mixins: [component, form],
        data(){
            return {
                formUpdate: {
                    remark: ''
                },
                rulesUpdate: Validator(this)
            }
        }
    }
</script>

<style scoped>

</style>