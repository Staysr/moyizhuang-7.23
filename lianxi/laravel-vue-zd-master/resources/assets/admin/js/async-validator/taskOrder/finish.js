export const Validator = (data) => {
    return {
        remark: [
            {
                required: true,
                trigger: 'blur',
                message: '取消备注必须填写'
            }
        ]
    }
};