export const Validator = (data) => {
    return {
        name: [
            {
                required: true,
                type: 'string',
                message: '地址必须填写',
                trigger: 'blur'
            }
        ],
        contacts: [{
            required: true,
            message: '联系人必须填写',
            type: 'string',
            trigger: 'blur'
        }],
        contact_way: [{
            required: true,
            message: '联系方式必须填写',
            type: 'string',
            trigger: 'blur'
        }]
    }
}