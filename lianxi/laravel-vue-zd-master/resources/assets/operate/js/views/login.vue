<template>
    <div>
      <div id="login">
        <div class="login_title">
          欢迎登陆
        </div>
        <div class="login_info">
          <!--电话认证-->
          <div class="login_phone">
            <label for="phone" class="icon_phone">
            </label>
            <input
              type="text"
              class="phone"     
              placeholder="请输入手机号码"
              maxlength="11"
              v-model="phone"
              v-verify='phone'
            >
            <label class="fl" v-remind="phone"></label>
          </div>
          <!--密码验证-->
          <div class="password">
            <label for="pass" class="icon_pass"></label>
            <input
              ref = 'pass'
              type="password"
              class="pass"
              placeholder="请输入密码"
              v-model="pass_info"
              v-verify="pass_info"
              @input="onfoucsInput"
            >
            <label class="fl" v-remind="pass_info"></label>
            <i class="eye_close" v-show="!isshow" @click="pass"></i>
            <i class="eye_open" v-show="isshow" @click="pass"></i>
          </div>
        </div>
        <!--按钮-->
        
        <button type="button" class="submit" @click="submit">登陆</button>
        
      </div>
      
      <toast type="text" v-model="showToast" :time="800" :position="position" :width="width">{{ message }}</toast>
    </div>
</template>

<script>
  import verify from "vue-verify-plugin"
  import Cache from '../plugins/cache/index.js'
  import { Toast } from 'vux'

  Vue.use(verify,{
    blur: true
  });

  export default {
    name: "login",
    components: {
      Toast
    },
    data () {
      return {
        isshow: true,
        pass_info: '',
        phone: '',
        position: 'middle',
        message: '',
        width: '',
        showToast: false
      }
    },
    verify: {
      pass_info: [ "required",
       {
         test: (val)=> {
           if( val.lenght != 0 ) {
             return true
           }else {
             return false
           }
         },
           message: '密码不能为空'
       }
      ],
      phone: ["required", "mobile"]
    },
    methods: {
      onfoucsInput() {
        if( this.pass_info.length >= 1 && this.$refs.pass.type == 'password') {
          this.isshow = false
        } else if ( this.$refs.pass.type == 'number' ||  this.pass_info.length == 0){
          this.isshow = true
        }
      },
      pass() {
        this.isshow = !this.isshow
        if(this.isshow) {
          this.$refs.pass.type = 'number'
        }else {
          this.$refs.pass.type = 'password'
        }
      },
      
      submit() {
    
        if(this.$verify.check()) {
          let form = { phone: this.phone, password: this.pass_info }
          this.$http.post('token', form ).then((res)=> {
              if( res.status == 200 ) {
                  this.showToast = true
                  this.message = "成功"
                  this.$cache.set('token', res.data.data.access_token)
                  this.$router.push('/')
              }
          }).catch((e)=> {
              this.showToast = true
              this.width="16em"
              this.message = "用户名或密码错误"

          })
        }

      },
    }
  }
</script>

<style lang="less">
::-webkit-input-placeholder {
  color: #999999;
}
:-moz-placeholder {
  color: #999;
}
  
  #login {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-size: cover;
        padding: 0 40px;
        z-index: 999;
        background: #fff;
         
         .login_title {
            font-size: 56px;
            text-align: center;
            color: #07CA61;
            margin-top: 200px;
         }

         .login_info {
            width: 100%;
            height: auto;
            margin-top: 125px;

            .login_phone, .password {
              width: 100%;
              height: 118px;
              display: flex;
              align-items:Center;
              border-bottom: 1px solid #DADADA;
              position: relative;

              .fl {
                  font-size: 20px;
                  color: red;
                  position: absolute;
                  left: 120px;
                  top: 116px;
                }

              .icon_phone, .icon_pass {
                margin: 0 40px;
                display: inline-block;
                background-size: cover;
                position: relative;

                &::after {
                  content: '';
                  display: inline-block;
                  height: 60px;
                  width: 2px;
                  border-right: 2px dashed #D8D8D8;
                  position: absolute;
                  left: 60px;
                  top: -10px;
                }          

              }
            
              .phone, .pass {
                position: absolute;
                font-size: 34px;
                margin-left: 144px;
              }

            }
            .eye_open, .eye_close {
              width: 45px;
              height: 29px;
              display: inline-block;
              background-size: cover;
              position: absolute;
              right: 59px;
            }
         }
         .submit {
           width: 100%;
           line-height: 96px;
           color: #fff;
           font-size: 34px;
           margin-top: 93px;
           background: #07CA61;
           text-align: center;
           border-radius: 10px;
           border-color: transparent;
         }
         
    }
    .icon_phone {
        height: 43.45px;
        width: 27.58px;
        background: url('../../images/phone.png') no-repeat center center;
    }
    .icon_pass {
      width: 29px;
      height: 36px;
      background: url('../../images/password.png') no-repeat center center;
    }
    .eye_open {
      background: url('../../images/login-eyeso.png') no-repeat center center;
    }
    .eye_close {
      background: url('../../images/eyec.png') no-repeat center center;
    }
</style>