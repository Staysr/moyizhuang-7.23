<template>
    <component-modal title="设置不配送" :width="450" :loading="loading">
        <Alert show-icon closable>设置之后，司机在 2018-08-24 将不会配送!</Alert>
        <Alert show-icon closable>如果司机在您设置后，报价其他该时间段的任务并被选中，您将不能再设置配送!</Alert>
        <Form :model="formUpdate" ref="formUpdate" :label-width="50" :rules="rulesUpdate">
            <FormItem label="备注" prop="remark">
                <Input v-model="formUpdate.remark" type="textarea"/>
            </FormItem>
        </Form>

        <div slot="footer">
            <Button type="primary" :loading="loading" @click="updateSubmit('formUpdate', `order/undo/${data.id}`)">提交
            </Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../components/modal/component-modal";
    import component from "../../mixins/component";
    import {Validator} from "../../async-validator/taskOrder/undo"
    import form from "../../mixins/form";


    export default {
        name: "undo",
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