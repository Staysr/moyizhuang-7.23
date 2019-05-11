import moment from 'moment'

export const Validator = (data) => {
    return {
        is_delivery: [
            {
                required: true,
                type: 'number',
                message: '请选择是否要求有配送经验',
                trigger: 'change',
            },
        ],
        dispatching: [
            {
                required: true,
                type: 'array',
                message: '请选择要求的配送经验',
                trigger: 'blur',
            },
        ],
        offer_end_time: [
            {
                required: true,
                message: '请选择司机报价截止时间',
                trigger: 'change',
            },
            {
                validator: (rule, value, callback) => {
                    let now = moment().format('YYYY-MM-DD HH:mm')
                    let earliest_time = data.publicConfig.earliest_quote_time
                    let latest_time = parseFloat((data.publicConfig.earliest_arrival_time - earliest_time).toFixed(10))
                    if (earliest_time && latest_time) {
                        if (moment(value).diff(now, 'minutes') < earliest_time * 60) {
                            callback(new Error('报价截止时间最早可设定为任务发布后' + earliest_time + '小时'))
                        } else {
                            let arrival = data.publicValue.arrival_date + ' ' + data.publicValue.arrival_warehouse_time
                            if (moment(arrival).diff(value, 'minutes') < latest_time * 60) {
                                callback(new Error('报价截止时间最晚可设定为上岗前' + latest_time + '小时'))
                            } else {
                                callback()
                            }
                        }
                    } else {
                        let type = data.publicValue.type === 1 ? '主' : (data.publicValue.type === 2 ? '临时' : '')
                        callback(new Error('未获取到' + type + '司机（任务）时间的配置信息'))
                    }
                },
                trigger: 'change',
            },
        ],
        choose_driver_end_time: [
            {
                validator: (rule, value, callback) => {
                    let end = data.publicValue.offer_end_time
                    if (end === '') {
                        callback(new Error('请先选择司机报价截止时间'))
                    } else {
                        let time = data.publicConfig.choose_driver_latest_time
                        if (time) {
                            if (moment(value).diff(end, 'minutes') !== time * 60) {
                                callback(new Error('为司机报价截止时间后' + time + '小时'))
                            } else {
                                callback()
                            }
                        } else {
                            let type = data.publicValue.type === 1 ? '主' : (data.publicValue.type === 2 ? '临时' : '')
                            callback(new Error('未获取到' + type + '司机（任务）时间的配置信息'))
                        }
                    }
                },
                trigger: 'change',
            },
        ],
        carry_type: [
            {
                required: true,
                type: 'number',
                message: '请选择搬运说明',
                trigger: 'change',
            },
        ],
        'carry.textarea': [
            {
                required: true,
                type: 'string',
                max: 300,
                message: '请详细描述司机搬运说明，最多输入300字',
                trigger: 'blur',
            },
        ],
        'carry.is_worker': [
            {
                required: true,
                type: 'number',
                message: '请选择是否自带小工',
                trigger: 'change',
            },
        ],
        'carry.is_loading': [
            {
                required: true,
                type: 'number',
                message: '请选择是否帮忙装货',
                trigger: 'change',
            },
        ],
        'carry.is_unloading': [
            {
                required: true,
                type: 'number',
                message: '请选择是否帮忙卸货',
                trigger: 'change',
            },
        ],
        'other.is_remove_seat': [
            {
                required: true,
                type: 'number',
                message: '请选择是否需要拆后座',
                trigger: 'change',
            },
        ],
        'other.is_trolley': [
            {
                required: true,
                type: 'number',
                message: '请选择是否需要小推车',
                trigger: 'change',
            },
        ],
        'other.is_tail_plate': [
            {
                required: true,
                type: 'number',
                message: '请选择是否需要带尾板',
                trigger: 'change',
            },
        ],
        'other.is_extinguisher': [
            {
                required: true,
                type: 'number',
                message: '请选择是否需要配备双灭火器',
                trigger: 'change',
            },
        ],
        'other.is_lock': [
            {
                required: true,
                type: 'number',
                message: '请选择是否需要配备明锁/暗锁',
                trigger: 'change',
            },
        ],
        'other.other_require': [
            {
                type: 'string',
                max: 300,
                message: '最多输入300字',
                trigger: 'blur',
            },
        ],
        supply_other: [
            {
                validator: (rule, value, callback) => {
                    if (data.supply.length > 300) {
                        callback(new Error('最多输入300字'))
                    } else {
                        callback()
                    }
                },
                trigger: 'blur',
            },
        ],
        welfare_other: [
            {
                validator: (rule, value, callback) => {
                    if (data.supply.length > 300) {
                        callback(new Error('最多输入300字'))
                    } else {
                        callback()
                    }
                },
                trigger: 'blur',
            },
        ],
    }
}