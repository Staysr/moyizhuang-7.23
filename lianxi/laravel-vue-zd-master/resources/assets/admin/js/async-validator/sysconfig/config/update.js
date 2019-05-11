export const Validator = (data) => {
    let rule = [
        {
            required: true,
            type: 'number',
            message: '不能为空',
            trigger: 'change'
        }
    ]
    return {
        driver_sign_before_time: rule,
        driver_sign_after_time: rule,
        driver_sign_radius: rule,
        driver_dispatch_after_warehouse: rule,
        master_driver_not_dispatch_before_warehouse: rule,
        temp_driver_not_dispatch_before_warehouse: rule,
        master_driver_task_free_driver_before_warehouse: rule,
        temp_driver_task_free_driver_before_warehouse: rule,
        master_driver_quote_latest_time: rule,
        master_driver_reach_earliest_time: rule,
        change_master_driver_latest_time_before_work: rule,
        master_driver_quote_lastest_time: rule,
        master_driver_quote_time_more_now: rule,
        master_driver_quote_time_add: rule,
        master_driver_quote_time_sub: rule,
        temp_driver_quote_earliest_time: rule,
        temp_driver_reach_earliest_time: rule,
        change_temp_driver_latest_time_before_work: rule,
        temp_driver_quote_lastest_time: rule,
        temp_driver_quote_time_more_now: rule,
        temp_driver_quote_time_more_add: rule,
        temp_driver_quote_time_more_sub: rule,
        task_conflict_time: rule,
        percentage: rule,
        update_offer_count: rule,
        cancel_offer_count: rule,
        cancel_offer_frozen_time: rule,
        sms_before_warehouse_time: rule
    }
}