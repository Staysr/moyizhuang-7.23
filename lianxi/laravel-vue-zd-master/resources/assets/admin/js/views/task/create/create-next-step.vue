<template>
    <div>
        <Form :model="publicValue" ref="next" :label-width="150" :rules="publicValueRules">
            <FormItem label="配送经验要求" prop="is_delivery">
                <RadioGroup v-model="publicValue.is_delivery" type="button">
                    <Radio :label="1" :value="1">有要求</Radio>
                    <Radio :label="0" :value="0">无要求</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem prop="dispatching" v-if="publicValue.is_delivery === 1">
                <checkbox-button-group v-model="publicValue.dispatching">
                    <checkbox-button value="生鲜农产品">生鲜农产品</checkbox-button>
                    <checkbox-button value="食品行业">食品行业</checkbox-button>
                    <checkbox-button value="快消品">快消品</checkbox-button>
                    <checkbox-button value="电子产品">电子产品</checkbox-button>
                    <checkbox-button value="图书">图书</checkbox-button>
                    <checkbox-button value="服装">服装</checkbox-button>
                    <checkbox-button value="建材">建材</checkbox-button>
                    <checkbox-button value="家居">家居</checkbox-button>
                    <checkbox-button value="汽车配件">汽车配件</checkbox-button>
                    <checkbox-button value="医院">医院</checkbox-button>
                    <checkbox-button value="物流行业">物流行业</checkbox-button>
                </checkbox-button-group>
            </FormItem>
            <FormItem label="司机报价截止时间" prop="offer_end_time">
                <c-date-picker v-model="offer_end_time"
                               type="datetime"
                               format="yyyy-MM-dd HH:mm"
                               :options="options">
                
                </c-date-picker>
                <br/>报价截止时间最早可设定为任务发布后{{publicConfig.earliest_quote_time}}小时,最晚可设定为上岗前{{parseFloat((publicConfig.earliest_arrival_time-publicConfig.earliest_quote_time).toFixed(10))}}小时 司机上岗时间已设置： {{publicValue.arrival_date}} {{publicValue.arrival_warehouse_time}}
            </FormItem>
            <FormItem label="选司机截止时间" prop="choose_driver_end_time">
                <c-date-picker v-model="publicValue.choose_driver_end_time"
                               type="datetime"
                               format="yyyy-MM-dd HH:mm"
                               readonly="readonly"
                               :options="options">
                
                </c-date-picker>
                <br/>选司机截止时间为司机报价截止时间后{{publicConfig.choose_driver_latest_time}}小时
            </FormItem>
            <FormItem label="搬运说明" prop="carry_type">
                <RadioGroup v-model="publicValue.carry_type" type="button">
                    <Radio :label="0" :value="0">无需搬运</Radio>
                    <Radio :label="1" :value="1">轻度搬运</Radio>
                    <Radio :label="2" :value="2">中度搬运</Radio>
                    <Radio :label="3" :value="3">重度搬运</Radio>
                </RadioGroup>
            </FormItem>
            <template v-if="publicValue.carry_type === 1 || publicValue.carry_type === 2 || publicValue.carry_type === 3">
                <FormItem prop="carry.textarea" style="width: 80%">
                    <Input v-model="publicValue.carry.textarea"
                           type="textarea"
                           placeholder="请详细描述司机搬运说明，例如：货物重量，形状，搬运距离、是否有电梯、是否有人协助....必填，最多300字。"/>
                </FormItem>
                <FormItem label="是否自带小工" prop="carry.is_worker">
                    <RadioGroup v-model="publicValue.carry.is_worker" type="button">
                        <Radio :label="1" :value="1">是</Radio>
                        <Radio :label="0" :value="0">否</Radio>
                    </RadioGroup>
                </FormItem>
                <FormItem label="是否帮忙装货" prop="carry.is_loading">
                    <RadioGroup v-model="publicValue.carry.is_loading" type="button">
                        <Radio :label="1" :value="1">是</Radio>
                        <Radio :label="0" :value="0">否</Radio>
                    </RadioGroup>
                </FormItem>
                <FormItem label="是否帮忙卸货" prop="carry.is_unloading">
                    <RadioGroup v-model="publicValue.carry.is_unloading" type="button">
                        <Radio :label="1" :value="1">是</Radio>
                        <Radio :label="0" :value="0">否</Radio>
                    </RadioGroup>
                </FormItem>
            </template>
            <FormItem label="需要拆后座" prop="other.is_remove_seat">
                <RadioGroup v-model="publicValue.other.is_remove_seat" type="button">
                    <Radio :label="1" :value="1">是</Radio>
                    <Radio :label="0" :value="0">否</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="需要小推车" prop="other.is_trolley">
                <RadioGroup v-model="publicValue.other.is_trolley" type="button">
                    <Radio :label="1" :value="1">是</Radio>
                    <Radio :label="0" :value="0">否</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="需要带尾板" prop="other.is_tail_plate">
                <RadioGroup v-model="publicValue.other.is_tail_plate" type="button">
                    <Radio :label="1" :value="1">是</Radio>
                    <Radio :label="0" :value="0">否</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="需要配备双灭火器" prop="other.is_extinguisher">
                <RadioGroup v-model="publicValue.other.is_extinguisher" type="button">
                    <Radio :label="1" :value="1">是</Radio>
                    <Radio :label="0" :value="0">否</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="需要配备明锁/暗锁" prop="other.is_lock">
                <RadioGroup v-model="publicValue.other.is_lock" type="button">
                    <Radio :label="1" :value="1">是</Radio>
                    <Radio :label="0" :value="0">否</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="其他上岗要求" prop="other.other_require" style="width: 80%">
                <Input v-model="publicValue.other.other_require"
                       type="textarea"
                       placeholder="如果对司机上岗还有其他要求，请在这里填写，方便司机报价，最多300字。"/>
            </FormItem>
            <FormItem label="任务补充说明">
                <checkbox-button-group v-model="publicValue.supply">
                    <checkbox-button value="需要出仓清点货物">需要出仓清点货物</checkbox-button>
                    <checkbox-button value="需要交接时清点货物">需要交接时清点货物</checkbox-button>
                    <checkbox-button value="需要参与仓内分拣">需要参与仓内分拣</checkbox-button>
                    <checkbox-button value="需要司机分餐">需要司机分餐</checkbox-button>
                    <checkbox-button value="需要参加上岗培训">需要参加上岗培训</checkbox-button>
                    <checkbox-button value="需要代收现金">需要代收现金</checkbox-button>
                    <checkbox-button value="需要穿您公司制服">需要穿您公司制服</checkbox-button>
                    <checkbox-button value="需要使用pos机代收款">需要使用pos机代收款</checkbox-button>
                </checkbox-button-group>
            </FormItem>
            <FormItem prop="supply_other" style="width: 80%">
                <Input v-model="supply" type="textarea" placeholder="如果对司机上岗还有其他要求，请在这里填写，方便司机报价，最多300字。"/>
            </FormItem>
            <FormItem label="司机福利补贴奖励">
                <checkbox-button-group v-model="publicValue.welfare">
                    <checkbox-button value="按件奖励">按件奖励</checkbox-button>
                    <checkbox-button value="有按配送点奖励">有按配送点奖励</checkbox-button>
                    <checkbox-button value="帮忙拓展业务奖励">帮忙拓展业务奖励</checkbox-button>
                    <checkbox-button value="报销停车费">报销停车费</checkbox-button>
                    <checkbox-button value="报销过路费">报销过路费</checkbox-button>
                    <checkbox-button value="报销油费">报销油费</checkbox-button>
                    <checkbox-button value="有加班费">有加班费</checkbox-button>
                    <checkbox-button value="提供饭补">提供饭补</checkbox-button>
                    <checkbox-button value="有假期">有假期</checkbox-button>
                    <checkbox-button value="提供住宿">提供住宿</checkbox-button>
                </checkbox-button-group>
            </FormItem>
            <FormItem prop="welfare_other" style="width: 80%">
                <Input v-model="welfare" type="textarea" placeholder="如果还有其他说明信息，请在这里填写，最多300字。"/>
            </FormItem>
            <FormItem label="是否显示" prop="other.is_show">
                <RadioGroup v-model="publicValue.is_show" type="button">
                    <Radio :label="1" :value="1">是</Radio>
                    <Radio :label="0" :value="0">否</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem>
                <Button type="primary" @click="ok('next')">立即发布</Button>
                <Button type="primary" @click="preview('next')">预览</Button>
                <Button @click="previous">上一步</Button>
            </FormItem>
        </Form>
    </div>
</template>

<script>
    import moment              from 'moment'
    import { Validator }       from '../../../async-validator/task/create/create-next'
    import CheckboxButtonGroup from '../../../components/checkbox/group-box'
    import CheckboxButton      from '../../../components/checkbox/index'
    import CDatePicker         from '../../../components/date-picker/index'

    export default {
        name: 'create-next-step',
        mixins: [],
        components: {
            CDatePicker,
            CheckboxButton,
            CheckboxButtonGroup,
        },
        props: {
            value: {
                type: Object,
                required: true,
            },
            config: {
                type: Object,
                required: true,
            },
            extra: {
                type: Object,
            },
        },
        data () {
            return {
                publicValue: this.value,
                publicConfig: this.config,
                readonly: true,
                options: {
                    disabledDate (date) {
                        return date && date.valueOf() < Date.now() - 86400000
                    },
                },
                supply: '',
                welfare: '',
                publicValueRules: Validator(this),
            }
        },
        mounted () {
            this.setExtra()
        },
        computed: {
            offer_end_time: {
                get () {
                    let now = moment().format('YYYY-MM-DD HH:mm')
                    let quote = this.publicConfig.earliest_quote_time
                    let choose = this.publicConfig.choose_driver_latest_time
                    if (quote && choose) {
                        let offer_end_time = moment(now).subtract(-quote * 60, 'minutes').format('YYYY-MM-DD HH:mm:ss')
                        this.$set(
                            this.publicValue,
                            'choose_driver_end_time',
                            moment(offer_end_time).subtract(-choose * 60, 'minutes').format('YYYY-MM-DD HH:mm'),
                        )
                        return this.publicValue.offer_end_time = offer_end_time
                    }
                },
                set (newValue) {
                    if (newValue !== '')
                        this.$set(
                            this.publicValue,
                            'choose_driver_end_time',
                            moment(newValue).subtract(-this.publicConfig.choose_driver_latest_time * 60, 'minutes').format('YYYY-MM-DD HH:mm'),
                        )
                    return this.publicValue.offer_end_time = newValue
                },
            },
        },
        methods: {
            setExtra () {
                if (this.$route.params.id) {
                    this.supply = this.extra.supply || ''
                    this.welfare = this.extra.welfare || ''
                }
            },
            ok (next) {
                this.$refs[next].validate((valid) => {
                    if (valid)
                        this.$emit('on-ok')
                })
            },
            preview (next) {
                this.$refs[next].validate((valid) => {
                    if (valid)
                        this.$emit('on-preview')
                })
            },
            previous () {
                this.$emit('on-previous')
            },
        },
        watch: {
            value: {
                handler (val) {
                    this.publicValue = val
                },
                deep: true,
            },
            config (val) {
                this.publicConfig = val
            },
            supply (newVal, oldVal) {
                if (oldVal !== '') {
                    let old = this.publicValue.supply.pop()
                    if (old !== oldVal)
                        this.publicValue.supply.push(old)
                }
                if (newVal !== '')
                    this.publicValue.supply.push(newVal)
            },
            'publicValue.supply' (newVal, oldVal) {
                if (this.supply !== '') {
                    if (this.publicValue.supply.indexOf(this.supply) === -1)
                        this.publicValue.supply.push(this.supply)
                }
            },
            welfare (newVal, oldVal) {
                if (oldVal !== '') {
                    let old = this.publicValue.welfare.pop()
                    if (old !== oldVal)
                        this.publicValue.welfare.push(old)
                }
                if (newVal !== '')
                    this.publicValue.welfare.push(newVal)
            },
            'publicValue.welfare' (newVal, oldVal) {
                if (this.welfare !== '') {
                    if (this.publicValue.welfare.indexOf(this.welfare) === -1)
                        this.publicValue.welfare.push(this.welfare)
                }
            },
        },
    }
</script>

<style scoped>

</style>