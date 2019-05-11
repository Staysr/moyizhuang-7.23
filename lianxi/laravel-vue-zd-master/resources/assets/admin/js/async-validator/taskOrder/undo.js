export const Validator = (data) => {
    return {
        remark: [
            {
                required: true,
                trigger: 'blur',
                message: '设置不配送备注必须填写'
            }
        ]
    }
};