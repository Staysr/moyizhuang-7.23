export const Validator = (data) => {
    return {
        merchant_id: [
            {
                required: true,
                type: 'number',
                message: '商户简称必须填写',
                trigger: 'change'
            }
        ],
        title: [
            {
                required: true,
                message: '仓名称必须填写',
                trigger: 'blur'
            }
        ],
        contacts: [{
            required: true,
            message: '联系人必须填写',
            trigger: 'blur'
        }],
        contacts_phone: [{
            required: true,
            message: '联系人手机号码必须填写',
            trigger: 'blur'
        }],
        address: [{
            required: true,
            message: '详细地址必须填写',
            trigger: 'change'
        }]
    }
}