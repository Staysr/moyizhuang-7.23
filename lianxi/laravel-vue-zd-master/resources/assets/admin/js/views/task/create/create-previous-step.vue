<template>
    <div>
        <Form :model="publicValue" ref="previous" :label-width="150" :rules="publicValueRules">
            <FormItem label="司机类型" prop="type">
                <RadioGroup v-model="publicValue.type" type="button">
                    <Radio :label="1" :value="1">招主司机</Radio>
                    <Radio :label="2" :value="2">招临时司机</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="选择商户" prop="merchant_id">
                <remote v-model="publicValue.merchant_id"
                        remote-url="merchants/select"
                        search-key="title"
                        :params="params"
                        style="width: 400px">
                
                </remote>
            </FormItem>
            <FormItem label="选择仓" prop="warehouse_id">
                <remote v-model="publicValue.warehouse_id"
                        remote-url="warehouse/select"
                        :ready="false"
                        :remote="false"
                        :params="{merchant_id: this.publicValue.merchant_id}"
                        style="width: 400px">
                
                </remote>
                <Button type="default" @click="go('warehouse.index')">新建仓</Button>
            </FormItem>
            <FormItem label="线路名称" prop="name">
                <Input v-model="publicValue.name" style="width: 400px" placeholder="线路名称，最多输入20字" clearable/>
            </FormItem>
            <FormItem label="配送点固定" prop="is_fixed_point">
                <RadioGroup v-model="publicValue.is_fixed_point" type="button">
                    <Radio :label="1" :value="1" :disabled="!publicValue.warehouse_id">是</Radio>
                    <Radio :label="0" :value="0" :disabled="!publicValue.warehouse_id">否</Radio>
                </RadioGroup>
            </FormItem>
            <template v-if="publicValue.is_fixed_point === 1 && publicValue.warehouse_id">
                <FormItem v-for="(item, index) in publicValue.delivery_point"
                          :label="index===0 ? '配送点信息' : ''"
                          :prop="'delivery_point.' + index"
                          :key="index"
                          style="width: 70%"
                          :rules="{
                              required: true,
                              type: 'object',
                              trigger: 'blur',
                              fields: {
                                  name: {required: true, type: 'string', message: '请输入有效地址'},
                                  contacts: {required: true, type: 'string', message: '请输入联系人'},
                                  contact_way: {required: true, pattern: /^1[34578]\d{9}$/, message: '请输入有效联系方式'}
                              }
                          }">
                    <Row>
                        <Col span="20">
                        <task-form-point v-model="publicValue.delivery_point[index]"></task-form-point>
                        </Col>
                        <Col span="4">
                        <div v-if="index === 0">
                            <Button @click="add">添加</Button>
                            <Button @click="importPoints">导入</Button>
                        </div>
                        <Button v-else @click="del(index)">删除</Button>
                        </Col>
                    </Row>
                </FormItem>
                <FormItem style="width: 70%">
                    <box title="地图">
                        <div class="amap-page-container">
                            <el-amap vid="amap">
                                <el-amap-marker v-for="(item, index) in publicValue.delivery_point"
                                                :key="index"
                                                :vid="`component-marker${index}`"
                                                :position="[item.lng, item.lat]"></el-amap-marker>
                            </el-amap>
                        </div>
                    </box>
                </FormItem>
            </template>
            <template v-if="publicValue.is_fixed_point === 0 && publicValue.warehouse_id">
                <FormItem label="配送点数量" prop="unfixed_json" :rules="currentRules.unfixed_json">
                    <number-range v-model="publicValue.unfixed_json" :unit="'个'"></number-range>
                </FormItem>
            </template>
            <template v-if="(publicValue.is_fixed_point === 0 || publicValue.is_fixed_point === 1) && publicValue.warehouse_id">
                <FormItem :label="publicValue.is_fixed_point===0 ? '配送区域描述' : '配送点备注'"
                          prop="delivery_point_remark"
                          style="width: 70%">
                    <Input v-model="publicValue.delivery_point_remark"
                           type="textarea"
                           placeholder="货物要配送到哪些区域？请尽量写明详细地址，有利于司机报价，最多输入300字"/>
                </FormItem>
            </template>
            <FormItem label="需要返仓" prop="is_back">
                <RadioGroup v-model="publicValue.is_back" type="button">
                    <Radio :label="1" :value="1">是</Radio>
                    <Radio :label="0" :value="0">否</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="配送总里程" prop="distance_json">
                <number-range v-model="publicValue.distance_json" :unit="'公里'"></number-range>
                如需返仓，配送总里程包括返仓公里数
            </FormItem>
            <FormItem label="配送时间" prop="send_time" v-if="publicValue.type === 1">
                <div class="checkbox-button-all"
                     :class="{ 'checkbox-button-all-checked':publicValue.send_time.length === 7 }"
                     @click="() => { publicValue.send_time.length === 7 ? this.publicValue.send_time = [] : this.publicValue.send_time = [1, 2, 3, 4, 5, 6, 7] }">全部
                </div>
                <checkbox-button-group v-model="publicValue.send_time">
                    <checkbox-button :value="1">周一</checkbox-button>
                    <checkbox-button :value="2">周二</checkbox-button>
                    <checkbox-button :value="3">周三</checkbox-button>
                    <checkbox-button :value="4">周四</checkbox-button>
                    <checkbox-button :value="5">周五</checkbox-button>
                    <checkbox-button :value="6">周六</checkbox-button>
                    <checkbox-button :value="7">周日</checkbox-button>
                </checkbox-button-group>
            </FormItem>
            <FormItem label="司机上岗日期"
                      prop="arrival_date"
                      v-if="publicValue.type === 1"
                      :rules="currentRules.arrival_date">
                <c-date-picker v-model="publicValue.arrival_date"
                               type="date"
                               :options="options">
                
                </c-date-picker>
            </FormItem>
            <FormItem label="配送时间" prop="temp_date" v-if="publicValue.type === 2">
                <c-date-picker v-model="temp_date"
                               type="daterange"
                               :options="options">
                
                </c-date-picker>
                <span>{{days}}天</span> <br/> 您可发起连续10天以内的临时司机线路任务，用车日期必须连续
            </FormItem>
            <FormItem label="到仓时间" prop="arrival_warehouse_time">
                <TimePicker v-model="publicValue.arrival_warehouse_time"
                            format="HH:mm"
                            :steps="[1, 5]"
                            :disabled="!publicValue.type"
                            :readonly="!publicValue.type"
                            placeholder="到仓时间"
                            clearable></TimePicker>
            </FormItem>
            <FormItem label="预计完成时间" prop="estimate_time">
                <TimePicker v-model="publicValue.estimate_time"
                            format="HH:mm"
                            :steps="[1, 5]"
                            placeholder="预计完成时间"
                            clearable></TimePicker>
                <span>{{timeDiff}}</span><br/> 如需返仓,该完成时间为司机返回至仓库的时间点
            </FormItem>
            <FormItem label="车型" prop="car_type_ids">
                <group-checkbox url="cartype/select" v-model="publicValue.car_type_ids"></group-checkbox>
            </FormItem>
            <FormItem label="保价服务" prop="merchant_safe_id">
                <group-radio url="safe/select" v-model="publicValue.merchant_safe_id"></group-radio>
                <br/>选择的保价服务将在司机签到时生效
            </FormItem>
            <FormItem label="货物类型" prop="goods_remark">
                <Input v-model="publicValue.goods_remark" style="width: 400px" placeholder="需要配送什么货物，最多20字" clearable/>
            </FormItem>
            <FormItem label="货物体积" prop="goods_volume">
                <number-range v-model="publicValue.goods_volume" :unit="'立方米'"></number-range>
            </FormItem>
            <FormItem label="货物总重量" prop="goods_weight">
                <number-range v-model="publicValue.goods_weight" :unit="'吨'"></number-range>
            </FormItem>
            <FormItem label="货物件数" prop="goods_num">
                <number-range v-model="publicValue.goods_num" :unit="'个/件/捆/箱'"></number-range>
            </FormItem>
            <FormItem label="需要回单" prop="back_bill">
                <RadioGroup v-model="publicValue.back_bill" type="button">
                    <Radio :label="1" :value="1">是</Radio>
                    <Radio :label="0" :value="0">否</Radio>
                </RadioGroup>
            </FormItem>
            <template v-if="publicValue.back_bill === 1">
                <FormItem label="回单方式" prop="receipt.type">
                    <Select v-model="publicValue.receipt.type" style="width:400px" clearable>
                        <Option :value="1">返仓交回</Option>
                        <Option :value="2">下次配送交回</Option>
                        <Option :value="3">快递</Option>
                        <Option :value="4">拍照发送电子版</Option>
                    </Select>
                </FormItem>
                <FormItem label="接收人" prop="receipt.recipient">
                    <Input v-model="publicValue.receipt.recipient" placeholder="接收人" style="width:400px" clearable/>
                </FormItem>
                <FormItem label="联系方式"
                          prop="receipt.phone"
                          v-if="publicValue.receipt.type === 1 || publicValue.receipt.type === 2 || publicValue.receipt.type === 4">
                    <Input v-model="publicValue.receipt.phone" placeholder="联系方式" style="width:400px" clearable/>
                </FormItem>
                <FormItem label="收件地址" prop="receipt.address" v-if="publicValue.receipt.type === 3">
                    <Input v-model="publicValue.receipt.address" placeholder="收件地址" style="width:400px" clearable/>
                </FormItem>
                <FormItem label="快递费" prop="receipt.express" v-if="publicValue.receipt.type === 3">
                    <RadioGroup v-model="publicValue.receipt.express">
                        <Radio :label="1" :value="1">司机承担</Radio>
                        <Radio :label="2" :value="2">客户承担（发货时选到付）</Radio>
                    </RadioGroup>
                </FormItem>
            </template>
            <FormItem label="预期单趟价格" prop="unit_price">
                <number-range v-model="publicValue.unit_price" :explanation="'您填写的预期价格,可以指导司机更合理报价'"></number-range>
            </FormItem>
            <FormItem label="报价说明" prop="price_remark">
                <Input v-model="publicValue.price_remark"
                       style="width: 400px"
                       placeholder="请输入影响司机报价的说明，最多输入20字"
                       clearable/>
            </FormItem>
            <FormItem>
                <Button type="primary" @click="next('previous')">下一步</Button>
            </FormItem>
        </Form>
        <components v-bind:is="component.current"
                    v-on:points="points"
                    @on-change="hideComponent"
                    :data="component.data"></components>
    </div>
</template>

<script>
    import moment              from 'moment'
    import { Validator }       from '../../../async-validator/task/create/create-previous'
    import component           from '../../../mixins/component'
    import lists               from '../../../mixins/lists'
    import Points              from './points'
    import Box                 from '../../../components/box/index'
    import Detail              from '../../../components/detail/index'
    import Remote              from '../../../components/select/remote'
    import NumberRange         from '../../../components/input/number-range'
    import CheckboxButtonGroup from '../../../components/checkbox/group-box'
    import CheckboxButton      from '../../../components/checkbox/index'
    import CDatePicker         from '../../../components/date-picker/index'
    import PlaceSearchSelect   from '../../../components/map/place-search-select'
    import TaskFormPoint       from '../../components/task/task-form-point'
    import GroupCheckbox       from '../../../components/checkbox/group-checkbox'
    import GroupRadio          from '../../../components/radio/group-radio'

    export default {
        name: 'create-previous-step',
        mixins: [component, lists],
        components: {
            GroupRadio,
            GroupCheckbox,
            TaskFormPoint,
            PlaceSearchSelect,
            CDatePicker,
            CheckboxButton,
            CheckboxButtonGroup,
            NumberRange,
            Remote,
            Detail,
            Box,
            Points
        },
        props: {
            value: {
                type: Object,
                required: true
            },
            config: {
                type: Object,
                required: true
            }
        },
        data () {
            return {
                publicValue: this.value,
                publicConfig: this.config,
                params: {},
                temp_date: [],
                options: {
                    disabledDate (date) {
                        return date && date.valueOf() < Date.now() - 86400000
                    }
                },
                currentRules: {
                    unfixed_json: {
                        required: true,
                        validator: (rule, value, callback) => {
                            if (/^[1-9]+$/.test(value.min)) {
                                if (/^[1-9]\d*$/.test(value.max)) {
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
                        },
                        trigger: 'blur'
                    },
                    arrival_date: [
                        {
                            required: true,
                            message: '请选择司机上岗日期',
                            trigger: 'blur'
                        },
                        {
                            validator: (rule, value, callback) => {
                                if (value < moment().format('YYYY-MM-DD'))
                                    callback(new Error('司机上岗日期不得小于当前日期'))
                                else
                                    callback()
                            },
                            trigger: 'blur'
                        }
                    ]
                },
                publicValueRules: Validator(this)
            }
        },
        computed: {
            days () {
                let temp_start = this.temp_date[0]
                let temp_end = this.temp_date[1]
                if (temp_start && temp_end) {
                    this.publicValue.temp_start_date = temp_start
                    this.publicValue.temp_end_date = temp_end
                    return moment(temp_end).diff(moment(temp_start), 'days') + 1
                } else {
                    delete this.publicValue.temp_start_date
                    delete this.publicValue.temp_end_date
                    return 0
                }
            },
            timeDiff () {
                let arrival = this.publicValue.arrival_warehouse_time
                let estimate = this.publicValue.estimate_time
                if (arrival && estimate && arrival !== estimate) {
                    let today = moment().format('YYYY-MM-DD') + ' '
                    let date = (arrival < estimate ? moment().format('YYYY-MM-DD') : moment().subtract(-1, 'days').format('YYYY-MM-DD')) + ' '
                    let minutes = moment(date + estimate).diff(moment(today + arrival), 'minutes')
                    let hours = moment(date + estimate).diff(moment(today + arrival), 'hours')
                    return minutes < 60 ? minutes + '分钟' : hours + '小时' + (minutes % 60 !== 0 ? minutes % 60 + '分钟' : '')
                }
            }
        },
        mounted () {
        },
        methods: {
            importPoints () {
                this.showComponent('Points', this.publicValue.warehouse_id)
            },
            points (val) {
                if (val.length > 0) {
                    let points = []
                    val.forEach((item, index) => {
                        points.push({
                            name: item.fixed_name,
                            lng: item.lng,
                            lat: item.lat,
                            contacts: item.contacts,
                            contact_way: item.contact_way
                        })
                    })
                    this.publicValue.delivery_point = points
                }
            },
            go (name) {
                this.$router.push({name})
            },
            add () {
                this.publicValue.delivery_point.push({
                    name: '',
                    lng: 0,
                    lat: 0,
                    contacts: '',
                    contact_way: ''
                })
            },
            del (index) {
                this.publicValue.delivery_point.splice(index, 1)
            },
            next (previous) {
                this.$refs[previous].validate((valid) => {
                    if (valid)
                        this.$emit('on-next')
                })
            }
        },
        watch: {
            value: {
                handler (val) {
                    this.publicValue = val
                },
                deep: true
            },
            publicValue (val) {
                let start = val.temp_start_date
                let end = val.temp_end_date
                if (start && end)
                    this.temp_date = [start, end]
                let num = val.goods_num
                if (num === null || (num.min === 0 && num.max === 0))
                    this.publicValue.goods_num = {}
            },
            config (val) {
                this.publicConfig = val
            },
            'publicValue.type' (val) {
                if (!this.$route.params.id) {
                    if (val === 1)
                        this.$set(this.publicValue, 'arrival_date', moment().format('YYYY-MM-DD'))
                    if (val === 2)
                        this.$delete(this.publicValue, 'arrival_date')
                } else {
                    if (val === 1 && !this.publicValue.send_time)
                        this.$set(this.publicValue, 'send_time', [])
                    if (val === 2)
                        this.$delete(this.publicValue, 'send_time')
                }
            },
            'publicValue.merchant.short_name' (val) {
                if (this.$route.params.id)
                    this.params = {title: val}
            },
            'publicValue.is_fixed_point' (val) {
                if (val === 1) {
                    if (!this.$route.params.id || !this.publicValue.delivery_point)
                        this.$set(this.publicValue, 'delivery_point', [
                            {
                                name: '',
                                lng: 0,
                                lat: 0,
                                contacts: '',
                                contact_way: ''
                            }
                        ])
                    this.$delete(this.publicValue, 'unfixed_json')
                } else {
                    if (!this.$route.params.id || !this.publicValue.unfixed_json)
                        this.publicValue.unfixed_json = {}
                    this.$delete(this.publicValue, 'delivery_point')
                }
            }
        }
    }
</script>

<style scoped>
    .amap-page-container {
        height: 400px;
        position: relative;
    }
    
    .long-lat-text {
        background-color: #ffffff;
        border: 1px #c0c0c0 solid;
        padding: 2px;
        position: absolute;
        top: 10px;
        right: 10px;
        border-radius: 6px;
    }
    
    .checkbox-button-all {
        vertical-align: middle;
        display: inline-block;
        height: 32px;
        line-height: 30px;
        margin: 0;
        padding: 0 15px;
        font-size: 12px;
        color: #515a6e;
        transition: all .2s ease-in-out;
        cursor: pointer;
        border: 1px solid #dcdee2;
        background: #fff;
        position: relative;
        border-radius: 4px;
    }
    
    .checkbox-button-all-checked {
        border-color: #2d8cf0;
        color: #2d8cf0;
    }
</style>