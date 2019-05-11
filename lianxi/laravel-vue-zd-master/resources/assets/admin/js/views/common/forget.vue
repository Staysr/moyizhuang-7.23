<template lang="html">
    <login-lock v-bind:message="a">
        <p slot="title">
            <Icon type="log-in"></Icon>
            找回密码
        </p>
        <Form slot="form" ref="formForget" :model="formForget" :rules="ruleForget">
            <FormItem prop="phone">
                <Input type="text" v-model.trim="formForget.phone" autocomplete="off" placeholder="手机号码">
                <Icon type="ios-phone-portrait" slot="prepend"></Icon>
                <a :loading="loading" :disabled="disabled" @click="verify(seconds)" slot="append">{{verifyName}}</a></Input>
            </FormItem>
            <FormItem prop="code">
                <Input type="text" v-model.trim="formForget.code" autocomplete="off" placeholder="验证码">
                <Icon type="ios-key" slot="prepend"></Icon>
                </Input>
            </FormItem>
            <FormItem prop="password">
                <Input type="password" v-model.trim="formForget.password" autocomplete="off" placeholder="密码">
                <Icon type="ios-lock" slot="prepend"></Icon>
                </Input>
            </FormItem>
            <FormItem prop="password_confirmation">
                <Input type="password" v-model.trim="formForget.password_confirmation" autocomplete="off" placeholder="确认密码">
                <Icon type="ios-lock" slot="prepend"></Icon>
                </Input>
            </FormItem>
            <FormItem>
                <Button type="primary" long @click="updateSubmit('formForget', 'token/forget')">确定</Button>
            </FormItem>
        </Form>
    </login-lock>
</template>

<script>
    import loginLock     from '../../views/common/components/lock/login-lock.vue'
    import { Validator } from '../../async-validator/common/forget/index'
    import component     from '../../mixins/component'
    import form          from '../../mixins/form'
    import http          from '../../mixins/http'

    export default {
        name: 'forget',
        mixins: [component, form, http],
        components: {loginLock},
        data () {
            return {
                seconds: 60,
                disabled: false,
                verifyName: '获取验证码',
                formForget: {
                    phone: '',
                    code: '',
                    password: '',
                    password_confirmation: ''
                },
                ruleForget: Validator(this),
                a: [
                    {
                        title: '登录',
                        click: 'common.login'
                    }
                ]
            }
        },
        methods: {
            verify (seconds) {
                if (this.validatPhone(this.formForget.phone)) {
                    if (this.seconds >= seconds) {
                        this.loading = true
                        this.$http.post(`token/sms`, {phone: this.formForget.phone}).then((res) => {
                            this.$Message.success(res.data.message)
                        }).catch((res) => {
                            this.formatErrors(res)
                        }).finally(() => {
                            this.loading = false
                        })
                    }
                    this.setCountdown(seconds)
                }
            },
            validatPhone (value) {
                if (!value) {
                    this.$Message.error('手机号码不能为空')
                } else {
                    if (!/^1[34578]\d{9}$/.test(value)) {
                        this.$Message.error('手机号码格式不正确')
                    } else {
                        return true
                    }
                }
                return false
            },
            setCountdown (seconds) {
                if (this.seconds === 0) {
                    this.disabled = false
                    this.verifyName = '重新获取'
                    this.seconds = seconds
                    return
                } else {
                    this.disabled = true
                    this.verifyName = '重新获取(' + this.seconds + 's)'
                    this.seconds--
                }
                setTimeout(() => {
                    this.setCountdown(seconds)
                }, 1000)
            }
        }
    }
</script>
