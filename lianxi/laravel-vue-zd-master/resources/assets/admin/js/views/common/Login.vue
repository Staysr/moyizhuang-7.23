<template lang="html">
    <login-lock v-bind:message="a">
        <p slot="title">
            <Icon type="log-in"></Icon>
            欢迎登录
        </p>
        <Form slot="form" ref="form" :model="form">
            <FormItem prop="phone"
                      :rules="{required: true, message: '手机号必须填写！', trigger: 'blur'}">
                <Input type="text" v-model="form.phone" autocomplete="off" placeholder="Phone">
                <Icon type="ios-phone-portrait" slot="prepend"></Icon>
                </Input>
            </FormItem>
            <FormItem prop="password" :rules="{required: true, message: '密码不能为空！', min: 6, max:20, trigger: 'blur'}">
                <Input type="password" v-model="form.password" autocomplete="off" placeholder="Password"
                       @on-enter="login('form')">
                <Icon type="ios-lock" slot="prepend"></Icon>
                </Input>
            </FormItem>
            <FormItem>
                <Button type="primary" long @click="login('form')">登录</Button>
            </FormItem>
        </Form>
    </login-lock>
</template>

<script>
    import loginLock from '@/admin/js/views/common/components/lock/login-lock.vue'
    import http      from '@/admin/js/mixins/http'

    export default {
        name: 'login',
        mixins: [http],
        components: {
            loginLock
        },
        data () {
            return {
                form: {
                    phone: '',
                    password: ''
                },
                a: [
                    {
                        title: '找回密码？',
                        click: 'common.forget'
                    }
                ]
            }
        },
        methods: {
            login (name) {
                this.$refs[name].validate((valid) => {
                    if (valid) {
                        this.$http.post(`token`, this.form).then((res) => {
                            this.$cache.set('token', res.data.data.access_token, {exp: res.data.data.expires_in})
                            this.$router.replace({name: 'common.home'})
                        }).catch((res) => {
                            this.formatErrors(res)
                        })
                    }
                })
            }
        }
    }
</script>
