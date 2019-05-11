<template>
    <component-modal title="运营取消" :width="350" :loading="loading">
        <Form :model="formUpdate" ref="formUpdate" :label-width="50" :rules="rulesUpdate">
            <FormItem label="备注" prop="remark">
                <Input v-model="formUpdate.remark" type="textarea"/>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" :loading="loading" @click="updateSubmit('formUpdate', `order/cancel/${data.id}`)">提交</Button>
        </div>
    </component-modal>
</template>

<script>
    import component from "../../mixins/component";
    import ComponentModal from "../../components/modal/component-modal";
    import {Validator} from "../../async-validator/taskOrder/cancel"
    import form from "../../mixins/form";


    export default {
        name: "cancel",
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