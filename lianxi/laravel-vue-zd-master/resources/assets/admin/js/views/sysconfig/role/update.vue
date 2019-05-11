<template>
    <component-modal title="修改角色" :loading="loading">
        <Form ref="formUpdate" :model="formUpdate" :label-width="80">
            <FormItem label="角色名称" prop="name" :rules="{required: true, message: '角色名称不能为空'}">
                <Input v-model="formUpdate.name" placeholder="角色名称" clearable/>
            </FormItem>
            <FormItem label="是否超管" prop="is_admin" :rules="{required: true, message: '选择是否为超级管理员'}">
                <RadioGroup v-model="formUpdate.is_admin" type="button">
                    <Radio :label="1" :value="1">是</Radio>
                    <Radio :label="0" :value="0">否</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="数据权限" prop="authority" :rules="{required: true, message: '选择是否启用数据权限'}">
                <RadioGroup v-model="formUpdate.authority" type="button">
                    <Radio :label="1" :value="1">启用</Radio>
                    <Radio :label="0" :value="0">禁用</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="城市" prop="categorys" :rules="{required: true, type: 'array', message: '选择城市'}">
                <group-checkbox url="category/checkbox" v-model="formUpdate.categorys"></group-checkbox>
            </FormItem>
            <FormItem label="角色描述" prop="remark">
                <Input v-model="formUpdate.remark" type="textarea" placeholder="角色描述"/>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" @click="updateSubmit('formUpdate', `role/${data.id}`)">更新</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from '@/admin/js/components/modal/component-modal'
    import form           from '@/admin/js/mixins/form'
    import component      from '@/admin/js/mixins/component'
    import GroupCheckbox  from '../../../components/checkbox/group-checkbox'

    export default {
        name: 'update',
        components: {
            GroupCheckbox,
            ComponentModal
        },
        mixins: [form, component],
        data () {
            return {
                formUpdate: {
                    name: '',
                    is_admin: '',
                    authority: '',
                    categorys: [],
                    remark: ''
                }
            }
        },
        mounted () {
            this.$http.get(`role/${this.data.id}`).then((res) => {
                this.formUpdate.name = res.data.data.name
                this.formUpdate.is_admin = res.data.data.is_admin
                this.formUpdate.authority = res.data.data.authority
                this.formUpdate.remark = res.data.data.remark
                this.loading = true
                this.$http.get(`role/${this.data.id}/category`).then((res) => {
                    res.data.data.forEach((item) => {
                        this.formUpdate.categorys.push(item.pivot.category_id)
                    })
                }).catch((err) => {
                    this.formatErrors(err)
                }).finally(() => {
                    this.loading = false
                })
            }).catch((err) => {
                this.formatErrors(err)
            })
        }
    }
</script>

<style scoped>

</style>