<template>
    <component-modal title="添加合同" :width="900" :loading="loading">

        <Form :model="formUpdate" ref="formUpdate" :label-width="100" :rules="ruleUpdate">
            <FormItem label="添加图片:" prop="images">
                <UploadList v-model="formUpdate.images" :max="6"></UploadList>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" :loading="loading" @click="updateSubmit('formUpdate', `contract/${data.id}`)">
                提交
            </Button>
        </div>

    </component-modal>
</template>

<script>
    import ComponentModal from "../../../components/modal/component-modal";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    import Box from "../../../components/box/index";
    import Remote from "../../../components/select/remote";
    import {Validator} from "../../../async-validator/contract/update";
    import UploadList from '../../../components/upload/uploadList'

    export default {
        components: {ComponentModal, Box, Remote, Validator, UploadList},
        name: "contract",
        mixins: [component, form],
        data() {
            return {
                formUpdate: {
                    images: []
                },
                ruleUpdate: Validator(this)
            }
        },
        methods: {},
        mounted() {
            this.loading = true;
            this.$http.get(`contract/` + this.data.id).then((res) => {
                this.formUpdate.images = res.data.data.data;
            }).finally(() => {
                this.loading = false
            })
        }

    }
</script>

<style scoped>

</style>
