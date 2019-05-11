<template lang="html">
    <div>
        <Card>
            <p slot="title">
                <Icon type="ios-settings-strong"></Icon>
                系统配置
            </p>
            <div>
                <Form :model="formUpdate" ref="formUpdate" :label-width="335" :rules="configUpdate">
                    <Card>
                        <p>
                            <Icon type="ios-list-outline"></Icon>
                            基本设置
                        </p>
                        <FormItem label="允许司机签到时间为到仓前：">
                            <Row>
                                <Col span="3">
                                <FormItem prop="driver_sign_before_time">
                                    <InputNumber :min="0"
                                                 :max="999"
                                                 :step="0.1"
                                                 v-model="formUpdate.driver_sign_before_time"></InputNumber>
                                    小时， 到仓后
                                </FormItem>
                                </Col>
                                <Col span="3">
                                <FormItem prop="driver_sign_after_time">
                                    <InputNumber :min="0"
                                                 :max="999"
                                                 :step="0.1"
                                                 v-model="formUpdate.driver_sign_after_time"></InputNumber>
                                    小时
                                </FormItem>
                                </Col>
                            </Row>
                        </FormItem>
                        <FormItem label="允许司机签到范围为仓库半径：" prop="driver_sign_radius">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.driver_sign_radius"></InputNumber>
                            公里
                        </FormItem>
                        <FormItem label="允许司机操作配送完成为离仓后：" prop="driver_dispatch_after_warehouse">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.driver_dispatch_after_warehouse"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="主司机设置不配送需要在到仓前：" prop="master_driver_not_dispatch_before_warehouse">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.master_driver_not_dispatch_before_warehouse"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="临时司机设置不配送需要在到仓前：" prop="temp_driver_not_dispatch_before_warehouse">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.temp_driver_not_dispatch_before_warehouse"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="主司机任务无责任解约司机需要在到仓前：" prop="master_driver_task_free_driver_before_warehouse">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.master_driver_task_free_driver_before_warehouse"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="临时司机任务无责任解约司机需要在到仓前：" prop="temp_driver_task_free_driver_before_warehouse">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.temp_driver_task_free_driver_before_warehouse"></InputNumber>
                            小时
                        </FormItem>
                    </Card>
                    
                    
                    <Card>
                        <p>
                            <Icon type="ios-list-outline"></Icon>
                            主司机（任务）时间设置
                        </p>
                        <FormItem label="最早报价截止时间：" prop="master_driver_quote_latest_time">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.master_driver_quote_latest_time"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="最早到仓时间：" prop="master_driver_reach_earliest_time">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.master_driver_reach_earliest_time"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="选司机截止时间为上岗前：" prop="change_master_driver_latest_time_before_work">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.change_master_driver_latest_time_before_work"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="司机报价最晚截止时间：" prop="master_driver_quote_lastest_time">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.master_driver_quote_lastest_time"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="默认司机报价截止时间，如果到仓时间距离现在时间大于：">
                            <Row>
                                <Col span="4">
                                <FormItem prop="master_driver_quote_time_more_now">
                                    <InputNumber :min="0"
                                                 :max="999"
                                                 :step="0.1"
                                                 v-model="formUpdate.master_driver_quote_time_more_now"></InputNumber>
                                    小时， 则现在时间加
                                </FormItem>
                                </Col>
                                <Col span="5">
                                <FormItem prop="master_driver_quote_time_add">
                                    <InputNumber :min="0"
                                                 :max="999"
                                                 :step="0.1"
                                                 v-model="formUpdate.master_driver_quote_time_add"></InputNumber>
                                    小时； 如果小于，则到仓时间减
                                </FormItem>
                                </Col>
                                <Col span="3">
                                <FormItem prop="master_driver_quote_time_sub">
                                    <InputNumber :min="0"
                                                 :max="999"
                                                 :step="0.1"
                                                 v-model="formUpdate.master_driver_quote_time_sub"></InputNumber>
                                    小时
                                </FormItem>
                                </Col>
                            </Row>
                        </FormItem>
                    </Card>
                    
                    
                    <Card>
                        <p>
                            <Icon type="ios-list-outline"></Icon>
                            临时司机（任务）时间设置
                        </p>
                        <FormItem label="最早报价截止时间：" prop="temp_driver_quote_earliest_time">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.temp_driver_quote_earliest_time"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="最早到仓时间：" prop="temp_driver_reach_earliest_time">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.temp_driver_reach_earliest_time"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="选司机截止时间为司机报价截止后：" prop="change_temp_driver_latest_time_before_work">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.change_temp_driver_latest_time_before_work"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="司机报价最晚截止时间：" prop="temp_driver_quote_lastest_time">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.temp_driver_quote_lastest_time"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="默认司机报价截止时间，如果到仓时间距离现在时间大于：">
                            <Row>
                                <Col span="4">
                                <FormItem prop="temp_driver_quote_time_more_now">
                                    <InputNumber :min="0"
                                                 :max="999"
                                                 :step="0.1"
                                                 v-model="formUpdate.temp_driver_quote_time_more_now"></InputNumber>
                                    小时， 则现在时间加
                                </FormItem>
                                </Col>
                                <Col span="5">
                                <FormItem prop="temp_driver_quote_time_more_add">
                                    <InputNumber :min="0"
                                                 :max="999"
                                                 :step="0.1"
                                                 v-model="formUpdate.temp_driver_quote_time_more_add"></InputNumber>
                                    小时； 如果小于，则到仓时间减
                                </FormItem>
                                </Col>
                                <Col span="3">
                                <FormItem prop="temp_driver_quote_time_more_sub">
                                    <InputNumber :min="0"
                                                 :max="999"
                                                 :step="0.1"
                                                 v-model="formUpdate.temp_driver_quote_time_more_sub"></InputNumber>
                                    小时
                                </FormItem>
                                </Col>
                            </Row>
                        </FormItem>
                    </Card>
                    
                    
                    <Card>
                        <p>
                            <Icon type="ios-list-outline"></Icon>
                            其他项
                        </p>
                        <FormItem label="任务冲突时间：" prop="task_conflict_time">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="0.1"
                                         v-model="formUpdate.task_conflict_time"></InputNumber>
                            小时
                        </FormItem>
                        <FormItem label="管理费提成比率(报价的X%)：" prop="percentage">
                            <InputNumber :min="0" :max="999" :step="0.1" v-model="formUpdate.percentage"></InputNumber>
                            %
                        </FormItem>
                        <FormItem label="司机报价可修改次数：" prop="update_offer_count">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="1"
                                         v-model="formUpdate.update_offer_count"></InputNumber>
                            次
                        </FormItem>
                        <FormItem label="司机第：">
                            <Row>
                                <Col span="5">
                                <FormItem prop="cancel_offer_count">
                                    <InputNumber :min="0"
                                                 :max="999"
                                                 :step="1"
                                                 v-model="formUpdate.cancel_offer_count"></InputNumber>
                                    次取消后，会被加入黑名单
                                </FormItem>
                                </Col>
                                <Col span="4">
                                <FormItem prop="cancel_offer_frozen_time">
                                    <InputNumber :min="0"
                                                 :max="999"
                                                 :step="1"
                                                 v-model="formUpdate.cancel_offer_frozen_time"></InputNumber>
                                    天内不能报价
                                </FormItem>
                                </Col>
                            </Row>
                        </FormItem>
                        <FormItem label="给所属队长发送未签到短信：" prop="is_send_leader">
                            <i-switch v-model="formUpdate.is_send_leader" :true-value="1" :false-value="0" size="large">
                                <span slot="open">是</span> <span slot="close">否</span>
                            </i-switch>
                        </FormItem>
                        <FormItem label="司机在到仓时间前(负数为后)：" prop="sms_before_warehouse_time">
                            <InputNumber :min="0"
                                         :max="999"
                                         :step="1"
                                         v-model="formUpdate.sms_before_warehouse_time"></InputNumber>
                            分钟未签到发送短信提醒
                        </FormItem>
                        <FormItem>
                            <Button type="primary"
                                    :loading="loading"
                                    @click="updateSubmit('formUpdate', 'config/update')">保存
                            </Button>
                        </FormItem>
                    </Card>
                </Form>
            </div>
        </Card>
    </div>
</template>

<script>
    import { Validator } from '../../../async-validator/sysconfig/config/update'
    import form          from '../../../mixins/form'
    import http          from '../../../mixins/http'
    import component     from '../../../mixins/component'

    export default {
        name: 'index',
        mixins: [form, http, component],
        data () {
            return {
                formUpdate: {
                    driver_sign_before_time: 0,
                    driver_sign_after_time: 0,
                    driver_sign_radius: 0,
                    driver_dispatch_after_warehouse: 0,
                    master_driver_not_dispatch_before_warehouse: 0,
                    temp_driver_not_dispatch_before_warehouse: 0,
                    master_driver_task_free_driver_before_warehouse: 0,
                    temp_driver_task_free_driver_before_warehouse: 0,
                    master_driver_quote_latest_time: 0,
                    master_driver_reach_earliest_time: 0,
                    change_master_driver_latest_time_before_work: 0,
                    master_driver_quote_lastest_time: 0,
                    master_driver_quote_time_more_now: 0,
                    master_driver_quote_time_add: 0,
                    master_driver_quote_time_sub: 0,
                    temp_driver_quote_earliest_time: 0,
                    temp_driver_reach_earliest_time: 0,
                    change_temp_driver_latest_time_before_work: 0,
                    temp_driver_quote_lastest_time: 0,
                    temp_driver_quote_time_more_now: 0,
                    temp_driver_quote_time_more_add: 0,
                    temp_driver_quote_time_more_sub: 0,
                    task_conflict_time: 0,
                    percentage: 0,
                    update_offer_count: 0,
                    cancel_offer_count: 0,
                    cancel_offer_frozen_time: 0,
                    is_send_leader: 0,
                    sms_before_warehouse_time: 0
                },
                configUpdate: Validator(this)
            }
        },
        mounted () {
            this.$nextTick(function () {
                this.$http.get(`config/index`).then((res) => {
                    this.formUpdate = Object.assign(this.unObserver(this.formUpdate), res.data.data)
                }).catch((err) => {
                    this.formatErrors(err)
                })
            })
        }
    }
</script>

<style lang="scss">

</style>
