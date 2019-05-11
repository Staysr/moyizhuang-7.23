export const Validator = (data) => {
    return {
        remark: [
            {
                required: true,
                trigger: 'blur',
                message: '代签到备注必须填写'
            }
        ]
    }
};