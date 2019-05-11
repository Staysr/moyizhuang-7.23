import moment from 'moment'

export const Validator = (data) => {
    let validatorInterregional = (
        rule,
        value,
        callback,
        regular1,
        regular2,
    ) => {
        if (regular1.test(value.min)) {
            if (regular2.test(value.max)) {
                if (value.min < value.max) {
                    callback()
                } else {
                    callback(new Error('最小值须小于最大值'))
                }
            } else {
                callback(new Error('请输入有效最大值'))
            }
        } else {
            callback(new Error('请输入有效最小值'))
        }
    }
    let interregionalRule = {
        required: true,
        validator: (rule, value, callback) => {
            validatorInterregional(rule, value, callback, /^\d+(\.\d{1,2})?$/, /^[1-9]\d*(\.\d{1,2})?$/)
        },
        trigger: 'blur',
    }
    return {
        type: [
            {
                required: true,
                type: 'number',
                message: '请选择司机类型',
                trigger: 'change',
            },
        ],
        merchant_id: [
            {
                required: true,
                type: 'number',
                message: '请选择商户',
                trigger: 'change',
            },
        ],
        warehouse_id: [
            {
                required: true,
                type: 'number',
                message: '请选择仓',
                trigger: 'change',
            },
        ],
        name: [
            {
                required: true,
                type: 'string',
                max: 20,
                message: '请输入线路名称，最多输入20字',
                trigger: 'blur',
            },
        ],
        is_fixed_point: [
            {
                required: true,
                type: 'number',
                message: '请选择配送点是否固定',
                trigger: 'change',
            },
        ],
        delivery_point_remark: [
            {
                required: true,
                type: 'string',
                max: 300,
                message: '请输入配送点备注，最多输入300字',
                trigger: 'blur',
            },
        ],
        /*unfixed_json: [
            {
                required: true,
                validator: (rule, value, callback) => {
                    validatorInterregional(rule, value, callback, /^\d+$/, /^[1-9]\d*$/)
                },
                trigger: 'blur',
            }
        ],*/
        is_back: [
            {
                required: true,
                type: 'number',
                message: '请选择是否需要返仓',
                trigger: 'change',
            },
        ],
        distance_json: [interregionalRule],
        send_time: [
            {
                required: true,
                type: 'array',
                message: '请选择配送时间',
                trigger: 'blur',
            },
        ],
        temp_date: [
            {
                required: true,
                validator: (rule, value, callback) => {
                    if (!data.temp_date[0] && !data.temp_date[1]) {
                        callback(new Error('请选择配送时间'))
                    } else {
                        let now = moment().format('YYYY-MM-DD')
                        if (data.temp_date[0] < now || data.temp_date[1] < now) {
                            callback(new Error('配送时间须小于当前日期'))
                        } else {
                            callback()
                        }
                    }
                },
                trigger: 'blur',
            },
        ],
        arrival_warehouse_time: [
            {
                required: true,
                message: '请选择到仓时间',
                trigger: 'change',
            },
            {
                validator: (rule, value, callback) => {
                    let arrival_date = data.publicValue.arrival_date
                    value = moment(arrival_date).format('YYYY-MM-DD') + ' ' + value
                    let now = moment().format('YYYY-MM-DD HH:mm')
                    let time = data.publicConfig.earliest_arrival_time
                    if (time) {
                        if (moment(value).diff(now, 'minutes') < (time * 60)) {
                            callback(new Error('到仓时间至少为当前时间后' + time + '小时'))
                        } else {
                            callback()
                        }
                    } else {
                        let type = data.publicValue.type === 1 ? '主' : (data.publicValue.type === 2 ? '临时' : '')
                        callback(new Error('未获取到' + type + '司机（任务）时间的配置信息'))
                    }
                },
                trigger: 'change',
            },
        ],
        estimate_time: [
            {
                required: true,
                message: '请选择预计完成时间',
                trigger: 'change',
            },
            {
                validator: (rule, value, callback) => {
                    value = moment().format('YYYY-MM-DD') + ' ' + value
                    let arrival = moment().format('YYYY-MM-DD') + ' ' + data.publicValue.arrival_warehouse_time
                    if (value === arrival) {
                        callback(new Error('预计完成时间与到仓时间不能相同'))
                    } else {
                        callback()
                    }
                },
                trigger: 'change',
            },
        ],
        car_type_ids: [
            {
                type: 'array',
                required: true,
                message: '请选择车型',
                trigger: 'blur',
            },
        ],
        goods_remark: [
            {
                required: true,
                type: 'string',
                max: 20,
                message: '请输入需要配送什么货物，最多20字',
                trigger: 'blur',
            },
        ],
        goods_volume: [interregionalRule],
        goods_weight: [interregionalRule],
        goods_num: [
            {
                validator: (rule, value, callback) => {
                    if (value.min || value.max || value.min === 0 || value.max === 0) {
                        validatorInterregional(rule, value, callback, /^\d+$/, /^[1-9]\d*$/)
                    } else {
                        callback()
                    }
                },
                trigger: 'blur',
            },
        ],
        back_bill: [
            {
                required: true,
                type: 'number',
                message: '请选择是否需要回单',
                trigger: 'change',
            },
        ],
        'receipt.type': [
            {
                required: true,
                type: 'number',
                message: '请选择回单方式',
                trigger: 'change',
            },
            {
                validator: (rule, value, callback) => {
                    if (value === 1 && data.publicValue.is_back !== 1) {
                        callback(new Error('请先选择需要返仓，否则不能选择返仓交回'))
                    } else {
                        callback()
                    }
                },
                trigger: 'change',
            },
        ],
        'receipt.recipient': [
            {
                required: true,
                type: 'string',
                message: '请输入接收人',
                trigger: 'blur',
            },
        ],
        'receipt.phone': [
            {
                required: true,
                pattern: /^1[34578]\d{9}$/,
                message: '请输入有效的联系方式',
                trigger: 'blur',
            },
        ],
        'receipt.address': [
            {
                required: true,
                type: 'string',
                message: '请输入收件地址',
                trigger: 'blur',
            },
        ],
        'receipt.express': [
            {
                required: true,
                type: 'number',
                message: '请输入快递费类型',
                trigger: 'blur',
            },
        ],
        unit_price: [
            {
                validator: (rule, value, callback) => {
                    if (value.min || value.max || value.min === 0 || value.max === 0) {
                        validatorInterregional(rule, value, callback, /^\d+(\.\d{1,2})?$/, /^[1-9]\d*(\.\d{1,2})?$/)
                    } else {
                        callback()
                    }
                },
                trigger: 'blur',
            },
        ],
        price_remark: [
            {
                type: 'string',
                max: 20,
                message: '请输入线路名称，最多输入20字',
                trigger: 'blur',
            },
        ],
    }
}