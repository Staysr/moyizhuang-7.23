<template lang="html">
    <div class="login">
        <div class="login-con">
            <Card :bordered="false">
                <p slot="title">
                    <slot name="title"></slot>
                </p>
                <div class="form-con">
                    <slot name="form"></slot>
                    <p class="login-tip" v-for="item in message">
                        <a slot="extra" @click="go(item.click)">{{item.title}}</a> 舟到后台管理系统
                    </p>
                </div>
            </Card>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'login-lock',
        components: {},
        data () {
            return {}
        },
        props: ['message'],
        methods: {
            go (name) {
                this.$router.push({name})
            }
        }
    }
</script>

<style lang="scss">
    .login {
        width: 100%;
        height: 100%;
        background-image: url("/images/admin/bg.jpg");
        background-size: cover;
        background-position: 50%;
        position: relative;
        
        .login-con {
            position: absolute;
            right: 160px;
            top: 50%;
            -webkit-transform: translateY(-60%);
            transform: translateY(-60%);
            width: 300px;
            
            .form-con {
                padding: 10px 0 0;
            }
            
            .login-tip {
                font-size: 10px;
                text-align: center;
                color: #c3c3c3;
            }
        }
    }

</style>
