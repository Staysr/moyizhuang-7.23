export const Validator = (data) => {
    return {
        fixed_name: [
            {
                required: false,
                type: 'string',
                message: '定位地址不能为空',
                trigger: 'blur'
            }
        ],
        lng: [
            {
                required: true,
                type: 'float',
                message: '经度不能为空'
            }
        ],
        lat: [
            {
                required: true,
                type: 'float',
                message: '纬度不能为空'
            }
        ]
    }
}