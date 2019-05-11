export const Validator = (data) => {
    return {
        money: [
            {
                required: true,
                trigger: 'blur',
                message: '还款金额必须填写'
            }
        ],
        remark: [
            {
                required: true,
                trigger: 'blur',
                message: '还款备注必须填写'
            }
        ]
    }
};