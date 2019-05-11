import moment from 'moment'

export const Validator = (data) => {
    return {
        remark: [
            {
                required: true,
                trigger: 'blur',
                message: '备注必须填写'
            },
        ],
        arrival_warehouse_time: [
            {
                required: true,
                trigger: 'blur',
                message: '到仓时间不能为空'
            }, {
                validator: (rule, value, callback) => {
                    if (moment(value).isBetween(moment().subtract('days', 2), moment().add('day', 1), 'day')) {
                        callback()
                    } else {
                        callback(new Error('到仓时间只能修改为昨天和今天时间'))
                    }
                },
                trigger: 'blur',
            }
        ],
        unit_price: [
            {
                required: true,
                trigger: 'blur',
                type: 'number',
                message: '单价不能为空'
            }
        ]
    }
};