import Vue from 'vue'
import VeeValidate, { Validator } from 'vee-validate'

Vue.use(VeeValidate);


Validator.extend('phone', {
    getMessage: field => '请输入正确的手机或单位固话（格式：区号-电话）',
    validate: value => value.length === 11 && /^((13|14|15|17|18)[0-9]{1}\d{8})$/.test(value) || /^(\d{3}-)(\d{8})$|^(\d{4}-)(\d{7})$|^(\d{4}-)(\d{8})$/.test(value)
});

Validator.extend('password', {
    getMessage: field => '密码长度必须在6到20个字符之间',
    validate: value => value.length >= 6 && value.length <= 20
});