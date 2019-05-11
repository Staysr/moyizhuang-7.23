<template>
    <component-modal title="更新用户" :loading="loading">
        <Form ref="formUpdate" :model="formUpdate" :label-width="80" :rules="ruleUpdate">
            <FormItem label="用户姓名" prop="name">
                <Input v-model="formUpdate.name" placeholder="用户姓名" clearable/>
            </FormItem>
            <FormItem label="手机号码" prop="phone">
                <Input v-model="formUpdate.phone" placeholder="手机号码" clearable/>
            </FormItem>
            <FormItem label="密码" prop="password">
                <Input type="password" v-model="formUpdate.password" placeholder="无输入则不更新密码" clearable/>
            </FormItem>
            <FormItem label="确认密码" prop="password_confirmation">
                <Input type="password" v-model="formUpdate.password_confirmation" placeholder="确认密码" clearable/>
            </FormItem>
            <FormItem label="所属角色" prop="role">
                <remote remote-url="role/select" :remote="false" :ready="true" @on-change="changRole"
                        v-model="formUpdate.role"></remote>
            </FormItem>
            <FormItem label="权限等级" prop="authority_level">
                <Select v-model="formUpdate.authority_level" placeholder="请选择等级" clearable>
                    <Option v-for="(item, index)  in authority_levels" :key="index" :value="item.id">{{item.name}}
                    </Option>
                </Select>
            </FormItem>
            <FormItem label="是否启用" prop="status">
                <RadioGroup v-model="formUpdate.status" type="button">
                    <Radio :label="1" :value="1">是</Radio>
                    <Radio :label="0" :value="0">否</Radio>
                </RadioGroup>
            </FormItem>
            <!--<FormItem label="部门管理者" prop="manager">
                <RadioGroup v-model="formUpdate.manager" type="button">
                    <Radio :label="0" :value="0">否</Radio>
                    <Radio :label="1" :value="1">是</Radio>
                </RadioGroup>
            </FormItem>-->
            <FormItem label="性别" prop="sex">
                <RadioGroup v-model="formUpdate.sex" type="button">
                    <Radio :label="1" :value="1">男</Radio>
                    <Radio :label="2" :value="2">女</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="工号" prop="job_number">
                <Input v-model="formUpdate.job_number" placeholder="工号" clearable/>
            </FormItem>
            <FormItem label="联系电话" prop="contact">
                <Input v-model="formUpdate.contact" placeholder="联系电话" clearable/>
            </FormItem>
            <FormItem label="生日" prop="birthday">
                <DatePicker v-model="formUpdate.birthday" type="date" placement="top" placeholder="生日"
                            clearable></DatePicker>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" :loading="loading" @click="updateSubmit('formUpdate', `admin/${data.id}`)">更新
            </Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from '@/admin/js/components/modal/component-modal'
    import form from '@/admin/js/mixins/form'
    import {Validator} from '../../../async-validator/sysconfig/admin/update'
    import component from '../../../mixins/component'
    import Remote from "../../../components/select/remote";

    export default {
        name: 'update',
        components: {
            Remote,
            ComponentModal
        },
        mixins: [component, form],
        data() {
            return {
                authority_levels: [{
                    id: 0,
                    name: '全部'
                }, {
                    id: 1,
                    name: '客户顾问'
                }, {
                    id: 2,
                    name: '运行经理'
                }, {
                    id: 3,
                    name: '扩展经理'
                }, {
                    id: 4,
                    name: '品质交互经理'
                }],
                formUpdate: {
                    name: '',
                    phone: '',
                    role: '',
                    password: '',
                    password_confirmation: '',
                    status: 1,
                    manager: 0,
                    authority_level: '',
                    sex: 0,
                    job_number: '',
                    contact: '',
                    birthday: ''
                },
                ruleUpdate: Validator(this)
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.loading = true
                this.$http.get(`admin/${this.data.id}`).then((res) => {
                    this.formUpdate = Object.assign(this.unObserver(this.formUpdate), res.data.data)
                }).catch((err) => {
                    this.formatErrors(err)
                }).finally(() => {
                    this.loading = false
                })
            })
        },
        methods: {
            changRole(obj) {
                this.formUpdate.authority_level = null;
                if (obj && obj.authority && obj.authority == 1) {
                    this.authority_levels = [{
                        id: 1,
                        name: '客户顾问'
                    }, {
                        id: 2,
                        name: '运行经理'
                    }, {
                        id: 3,
                        name: '扩展经理'
                    }, {
                        id: 4,
                        name: '品质交互经理'
                    }];
                } else {
                    this.authority_levels = [{
                        id: 0,
                        name: '全部'
                    }];
                }
            }
        }
    }
</script>

<style scoped>
</style>