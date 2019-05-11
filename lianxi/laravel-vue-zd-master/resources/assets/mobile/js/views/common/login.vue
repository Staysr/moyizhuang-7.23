<template>
    <div id="login">
        <div class="login_title">
            欢迎登陆
        </div>
        <div class="login_info">
            <div class="login_phone">
                <label class="icon_phone"></label>
                <input type="text" class="phone" name="createFrom.phone" v-model="createFrom.phone"
                       v-validate="'phone'"
                       :class="{'is-danger': errors.has('createFrom.phone') }"
                       placeholder="请输入手机号码" maxlength="11">
            </div>
            <div class="password">
                <label class="icon_pass"></label>
                <input :type="passwordType" v-model="createFrom.password" class="pass" name="createFrom.password"
                       v-validate="'password'"
                       :class="{'is-danger': errors.has('createFrom.password') }"
                       placeholder="请输入密码">
                <i :class="`eye_${eye}`" @click="clickEye"></i>
            </div>
        </div>
        <button type="button" class="submit" @click="login">登陆</button>

    </div>
</template>

<script>
    import '../../plugins/validate/index'

    export default {
        name: "login",
        data() {
            let phone = this.$cache.get('phone')
            let password = this.$cache.get('password')
            return {
                passwordType: 'password',
                createFrom: {
                    phone: phone,
                    password: password
                },
                validate: {
                    show: false,
                    msg: ''
                }
            }
        },
        computed: {
            eye() {
                return this.passwordType === 'password' ? 'close' : 'open';
            }
        },
        methods: {
            clickEye() {
                if (this.passwordType === 'password') {
                    this.passwordType = 'text'
                } else {
                    this.passwordType = 'password'
                }
            },
            login() {
                this.$validator.validateAll().then((result) => {
                    if (!result) {
                        this.$toast.center(this.errors.all().join("\n"));
                    }else{
                       
                        this.$http.post(`token`, this.createFrom).then((res)=>{
                            this.$store.commit('setAuth', res.data.data.access_token)
                            this.$cache.set('phone', this.createFrom.phone)
                            this.$cache.set('password', this.createFrom.password)
                            this.$router.replace({
                                name: 'common.choose'
                            });
                        })
                    }
                });
            }
        }
    }
</script>

<style scoped lang="less">
    @import '../../../less/login';
</style>