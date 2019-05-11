export const Validator = (data) => {
    let validateConfirm = (rule, value, callback) => {
        if (data.formForget.password !== value) {
            callback(new Error('两次密码不相同'))
        } else {
            callback()
        }
    }

    return {
        phone: [
            {required: true, message: '手机号码不能为空', trigger: 'blur'},
            {pattern: /^1[34578]\d{9}$/, message: '手机号码格式不正确', trigger: 'blur'}
        ],
        code: [
            {
                required: true,
                message: '验证码不能为空',
                trigger: 'blur'
            }
        ],
        password: [
            {
                required: true,
                message: '密码不能为空',
                trigger: 'blur'
            },
            {
                min: 6,
                max: 20,
                type: 'string',
                message: '密码必须在 6 到 20 个字符之间',
                trigger: 'blur'
            }
        ],
        password_confirmation: [
            {required: true, message: '确认密码不能为空', trigger: 'blur'},
            {validator: validateConfirm, trigger: 'blur'}
        ],
    }
}