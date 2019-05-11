<template>
    <component-modal title="创建保险" :loading="loading">
        <Form ref="formCreate" :model="formCreate" :label-width="100">
            <FormItem label="保险类型：" prop="type" :rules="{required: true, message: '请选择保险类型'}">
                <RadioGroup v-model="formCreate.type" type="button">
                    <Radio :label="1" :value="1">商业险</Radio>
                    <Radio :label="2" :value="2">司机险</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="保险名称：" prop="title" :rules="{required: true, message: '保险名称不能为空'}">
                <Input v-model="formCreate.title" placeholder="保险名称"/>
            </FormItem>
            <FormItem label="保障方式：" prop="is_per" :rules="{required: true, message: '请选择保障方式'}">
                <RadioGroup v-model="formCreate.is_per" type="button" @on-change="change()">
                    <Radio :label="0" :value="0">按金额购买</Radio>
                    <Radio :label="1" :value="1">按运费X%购买</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="保障服务费：" prop="safe_fee" :rules="{required: true, message: '保障服务费不能为空'}">
                <Col span="22">
                <Input v-model="formCreate.safe_fee" placeholder="保障服务费"/></Col>&nbsp;{{this.is_per}}
            </FormItem>
            <FormItem label="最高赔付：" prop="max_payment" :rules="{required: true, message: '最高赔付不能为空'}">
                <Row>
                    <Col span="22">
                    <Input v-model="formCreate.max_payment" placeholder="最高赔付"/></Col>&nbsp;万元
                </Row>
            </FormItem>
            <FormItem label="是否启用：" prop="status" :rules="{required: true, message: '请选择是否启用'}">
                <i-switch v-model="formCreate.status" :true-value="1" :false-value="0" size="large">
                    <span slot="open">是</span> <span slot="close">否</span>
                </i-switch>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" :loading="loading" @click="createSubmit('formCreate', 'safe/store')">创建</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from '../../../components/modal/component-modal'
    import form           from '../../../mixins/form'
    import component      from '../../../mixins/component'

    export default {
        name: 'create',
        components: {ComponentModal},
        mixins: [form, component],
        data () {
            return {
                is_per: '元',
                formCreate: {
                    type: 1,
                    title: '',
                    is_per: 0,
                    safe_fee: '',
                    max_payment: '',
                    status: 1
                }
            }
        },
        methods: {
            change () {
                this.is_per = this.is_per === '元' ? '%' : '元'
            }
        }
    }
</script>

<style scoped>

</style>