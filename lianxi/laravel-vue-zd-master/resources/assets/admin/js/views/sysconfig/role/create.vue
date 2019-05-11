<template>
    <component-modal title="创建角色" :loading="loading">
        <Form ref="formCreate" :model="formCreate" :label-width="80">
            <FormItem label="角色名称" prop="name" :rules="{required: true, message: '角色名称不能为空'}">
                <Input v-model="formCreate.name" placeholder="角色名称" clearable></Input>
            </FormItem>
            <FormItem label="是否超管" prop="is_admin" :rules="{required: true, message: '选择是否为超级管理员'}">
                <RadioGroup v-model="formCreate.is_admin" type="button">
                    <Radio :label="1" :value="1">是</Radio>
                    <Radio :label="0" :value="0">否</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="数据权限" prop="authority" :rules="{required: true, message: '选择是否启用数据权限'}">
                <RadioGroup v-model="formCreate.authority" type="button">
                    <Radio :label="1" :value="1">启用</Radio>
                    <Radio :label="0" :value="0">禁用</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="城市" prop="categorys" :rules="{required: true, type: 'array', message: '选择城市'}">
                <group-checkbox url="category/checkbox" v-model="formCreate.categorys"></group-checkbox>
            </FormItem>
            <FormItem label="角色描述">
                <Input v-model="formCreate.remark" type="textarea" placeholder="角色描述"></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" :loading="loading" @click="createSubmit('formCreate', 'role')">创建</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from '../../../components/modal/component-modal'
    import form           from '@/admin/js/mixins/form'
    import component      from '@/admin/js/mixins/component'
    import GroupCheckbox  from '../../../components/checkbox/group-checkbox'

    export default {
        name: 'create',
        components: {
            GroupCheckbox,
            ComponentModal
        },
        mixins: [form, component],
        data () {
            return {
                formCreate: {
                    name: '',
                    is_admin: '',
                    authority: '',
                    categorys: [],
                    remark: ''
                }
            }
        }
    }
</script>

<style scoped>

</style>