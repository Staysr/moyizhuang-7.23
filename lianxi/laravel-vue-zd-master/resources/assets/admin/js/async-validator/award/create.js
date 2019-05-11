export const Validator = (data) => {
    return {
        merchant_id: [
            {
                required: true,
                type: 'number',
                message: '商户简称必须填写',
                trigger: 'blur'
            }
        ],
        order_id: [
            {
                required: true,
                type: 'number',
                message: '出车单号必须填写',
                trigger: 'blur'
            }
        ],
        type: [{
            required: true,
            message: '类型必须填写',
            type: 'number',
            trigger: 'blur'
        }],
        fee: [{
            required: true,
            type: 'string',
            message: '金额必须填写',
            trigger: 'blur'
        }],
        reason: [{
            required: true,
            type: 'string',
            message: '原因必须填写',
            trigger: 'blur'
        }]
    }
}