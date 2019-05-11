<template>
    <Form :label-width="150">
        <Card>
            <Row>
                <Col span="8">
                <FormItem label="司机类型：">
                    <span v-if="publicValue.type === 1">主司机</span>
                    <span v-else-if="publicValue.type === 2">临时司机</span>
                </FormItem>
                </Col>
                <Col span="8">
                <FormItem label="商户名称：">{{merchant_name}}</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="仓名称：">{{warehouse_name}}</FormItem>
                </Col>
            </Row>
            
            <Row>
                <Col span="8">
                <FormItem label="线路名称：">{{publicValue.name}}</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="是否需要返仓：">{{publicValue.is_back === 0 ? '否' : '是'}}</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="配送总里程：">{{publicValue.distance_json|formatJson}} 公里</FormItem>
                </Col>
            </Row>
            
            <Row>
                <Col span="8">
                <FormItem label="配送点固定：">{{publicValue.is_fixed_point === 0 ? '否' : '是'}}</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="配送点数量：" v-if="publicValue.is_fixed_point === 0">
                    {{publicValue.unfixed_json|formatJson}} 个
                </FormItem>
                </Col>
                <Col span="8">
                <FormItem :label="publicValue.is_fixed_point === 0 ? '配送区域描述：' : '配送点备注：'">
                    {{publicValue.delivery_point_remark}}
                </FormItem>
                </Col>
            </Row>
            
            <FormItem label="配送点信息：" v-if="publicValue.is_fixed_point === 1" style="width: 85%">
                <my-table :columns="columns"
                          :data="publicValue.delivery_point"
                          size="small"
                          ref="table"
                          :loading="loading">
                
                </my-table>
            </FormItem>
        </Card>
        
        
        <Card>
            <Row>
                <Col span="8">
                <FormItem label="配送时间：">
                    <span v-if="publicValue.type === 1">{{publicValue.send_time|arrToWeek}}</span>
                    <span v-else-if="publicValue.type === 2">{{publicValue.temp_start_date + ' - ' + publicValue.temp_end_date}}</span>
                </FormItem>
                </Col>
                <Col span="8">
                <FormItem label="司机上岗日期：" v-if="publicValue.type === 1">{{publicValue.arrival_date}}</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="到仓时间：">{{publicValue.arrival_warehouse_time}}</FormItem>
                </Col>
            </Row>
            
            <Row>
                <Col span="8">
                <FormItem label="预计完成时间：">{{publicValue.estimate_time}}</FormItem>
                </Col>
                <Col span="16">
                <FormItem label="车型：">{{car_type_name}}</FormItem>
                </Col>
            </Row>
        </Card>
        
        
        <Card>
            <Row>
                <Col span="8">
                <FormItem label="保价服务：">{{safe_name}}</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="货物类型：">{{publicValue.goods_remark}}</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="货物体积：">{{publicValue.goods_volume|formatJson}} 立方米</FormItem>
                </Col>
            </Row>
            
            
            <Row>
                <Col span="8">
                <FormItem label="货物总重量：">{{publicValue.goods_weight|formatJson}} 吨</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="货物件数：">
                <span v-if="publicValue.goods_num.min && publicValue.goods_num.max">
                    {{publicValue.goods_num|formatJson}} 个/件/捆/箱
                </span>
                    <span v-else>无</span>
                </FormItem>
                </Col>
                <Col span="8">
                <FormItem label="预期单趟价格：">
                <span v-if="publicValue.unit_price.min && publicValue.unit_price.max">
                    {{publicValue.unit_price|formatJson}}
                </span>
                    <span v-else>无</span>
                </FormItem>
                </Col>
            </Row>
            
            <Row>
                <Col span="8">
                <FormItem label="报价说明：">{{publicValue.price_remark || '无'}}</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="是否需要回单：">{{publicValue.other.back_bill === 0 ? '否' : '是'}}</FormItem>
                </Col>
                <Col span="8" v-if="publicValue.back_bill === 1">
                <FormItem label="回单方式：">
                    <span v-if="publicValue.receipt.type === 1">返仓交回</span>
                    <span v-else-if="publicValue.receipt.type === 2">下次配送交回</span>
                    <span v-else-if="publicValue.receipt.type === 3">快递</span>
                    <span v-else-if="publicValue.receipt.type === 4">拍照发送电子版</span>
                </FormItem>
                </Col>
            </Row>
            
            <Row v-if="publicValue.back_bill === 1">
                <Col span="8">
                <FormItem label="接收人：">{{publicValue.receipt.recipient}}</FormItem>
                </Col>
                <div v-if="publicValue.receipt.type === 3">
                    <Col span="8">
                    <FormItem label="收件地址：">{{publicValue.receipt.address}}</FormItem>
                    </Col>
                    <Col span="8">
                    <FormItem label="快递费：">
                        <span v-if="publicValue.receipt.express === 1">司机承担</span>
                        <span v-else-if="publicValue.receipt.express === 2">客户承担（发货时选到付）</span>
                    </FormItem>
                    </Col>
                </div>
                <div v-else>
                    <Col span="8">
                    <FormItem label="联系方式：">{{publicValue.receipt.phone}}</FormItem>
                    </Col>
                </div>
            </Row>
        </Card>
        
        
        <Card>
            <Row>
                <Col span="8">
                <FormItem label="配送经验要求：">
                    <div v-if="publicValue.is_delivery === 0">无要求</div>
                    <div v-else>{{publicValue.dispatching|arrToString}}</div>
                </FormItem>
                </Col>
                <Col span="8">
                <FormItem label="司机报价截止时间：">{{publicValue.offer_end_time}}</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="选司机截止时间：">{{publicValue.choose_driver_end_time}}</FormItem>
                </Col>
            </Row>
        </Card>
        
        
        <Card>
            <div v-if="publicValue.carry_type !== 0">
                <Row>
                    <Col span="8">
                    <FormItem label="搬运说明：">
                        <p v-if="publicValue.carry_type === 0">无需搬运</p>
                        <p v-else-if="publicValue.carry_type === 1">轻度搬运</p>
                        <p v-else-if="publicValue.carry_type === 2">中度搬运</p>
                        <p v-else-if="publicValue.carry_type === 3">重度搬运</p>
                        <p v-if="publicValue.carry_type !== 0 && publicValue.carry.textarea">
                            其他：{{publicValue.carry.textarea || '无'}}
                        </p>
                    </FormItem>
                    </Col>
                    <Col span="8">
                    <FormItem label="是否自带小工：">{{publicValue.carry.is_worker === 0 ? '否' : '是'}}</FormItem>
                    </Col>
                    <Col span="8">
                    <FormItem label="是否帮忙装货：">{{publicValue.carry.is_loading === 0 ? '否' : '是'}}</FormItem>
                    </Col>
                </Row>
                
                <Row>
                    <Col span="8">
                    <FormItem label="是否帮忙卸货：">{{publicValue.carry.is_unloading === 0 ? '否' : '是'}}</FormItem>
                    </Col>
                    <Col span="8">
                    <FormItem label="需要拆后座：">{{publicValue.other.is_remove_seat === 0 ? '否' : '是'}}</FormItem>
                    </Col>
                    <Col span="8">
                    <FormItem label="需要小推车：">{{publicValue.other.is_trolley === 0 ? '否' : '是'}}</FormItem>
                    </Col>
                </Row>
            </div>
            
            <Row v-else>
                <Col span="8">
                <FormItem label="搬运说明：">
                    <p v-if="publicValue.carry_type === 0">无需搬运</p>
                    <p v-else-if="publicValue.carry_type === 1">轻度搬运</p>
                    <p v-else-if="publicValue.carry_type === 2">中度搬运</p>
                    <p v-else-if="publicValue.carry_type === 3">重度搬运</p>
                    <p v-if="publicValue.carry_type !== 0 && publicValue.carry.textarea">
                        其他：{{publicValue.carry.textarea || '无'}}
                    </p>
                </FormItem>
                </Col>
                <Col span="8">
                <FormItem label="需要拆后座：">{{publicValue.other.is_remove_seat === 0 ? '否' : '是'}}</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="需要小推车：">{{publicValue.other.is_trolley === 0 ? '否' : '是'}}</FormItem>
                </Col>
            </Row>
            
            <Row>
                <Col span="8">
                <FormItem label="需要带尾板：">{{publicValue.other.is_tail_plate === 0 ? '否' : '是'}}</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="需要配备双灭火器：">{{publicValue.other.is_extinguisher === 0 ? '否' : '是'}}</FormItem>
                </Col>
                <Col span="8">
                <FormItem label="需要配备明锁/暗锁：">{{publicValue.other.is_lock === 0 ? '否' : '是'}}</FormItem>
                </Col>
            </Row>
            
            <Row>
                <Col span="8">
                <FormItem label="其他上岗要求：">{{publicValue.other.other_require || '无'}}</FormItem>
                </Col>
            </Row>
        </Card>
        
        
        <Card>
            <Row>
                <Col span="8">
                <FormItem label="任务补充说明：">
                    <div v-if="publicValue.supply.length > 0">{{publicValue.supply|arrToString}}</div>
                    <div v-else>无</div>
                </FormItem>
                </Col>
                <Col span="8">
                <FormItem label="司机福利补贴奖励：">
                    <div v-if="publicValue.welfare.length > 0">{{publicValue.welfare|arrToString}}</div>
                    <div v-else>无</div>
                </FormItem>
                </Col>
                <Col span="8">
                <FormItem label="是否显示：">{{publicValue.is_show === 0 ? '否' : '是'}}</FormItem>
                </Col>
            </Row>
            <formItem>
                方舟货的将依据《方舟货的客户服务条款》为您提供服务。
            </formItem>
            <FormItem>
                <Button type="primary" @click="ok">立即发布</Button>
                <Button @click="cancelPrevious">取消预览</Button>
            </FormItem>
        </Card>
    </Form>
</template>

<script>
    import MyTable   from '../../../components/table/my-table'
    import component from '../../../mixins/component'
    import Box       from '../../../components/box/index'
    import Detail    from '../../../components/detail/index'

    export default {
        name: 'create-preview',
        mixins: [component],
        components: {
            Detail,
            Box,
            MyTable
        },
        props: {
            value: {
                type: Object,
                required: true
            }
        },
        data () {
            return {
                publicValue: this.value,
                merchant_name: '',
                warehouse_name: '',
                safe_name: '未选择',
                car_type_name: '',
                columns: [
                    {
                        title: '地址',
                        key: 'name'
                    },
                    {
                        title: '联系人',
                        key: 'contacts'
                    },
                    {
                        title: '联系方式',
                        key: 'contact_way'
                    }
                ]
            }
        },
        computed: {},
        mounted () {
            this.warehouse()
            this.safe()
            this.carTypeName()
        },
        methods: {
            warehouse () {
                let warehouse_id = this.publicValue.warehouse_id
                if (warehouse_id) {
                    this.$http.get(`warehouse/${warehouse_id}`).then((res) => {
                        this.merchant_name = res.data.data.merchant.short_name
                        this.warehouse_name = res.data.data.title
                    })
                }
            },
            safe () {
                let merchant_safe_id = this.publicValue.merchant_safe_id
                if (merchant_safe_id) {
                    this.$http.get(`safe/${merchant_safe_id}`).then((res) => {
                        this.safe_name = res.data.data.title
                    })
                }
            },
            carTypeName () {
                let ids = this.publicValue.car_type_ids
                if (ids && ids instanceof Array) {
                    this.$http.get(`cartype/select`).then((res) => {
                        let allCars = []
                        res.data.data.forEach((item, index) => {
                            allCars[item.id] = item.name
                        })
                        let myCars = []
                        ids.forEach((item, index) => {
                            myCars.push(allCars[item])
                        })
                        this.car_type_name = myCars.join('，')
                    })
                }
            },
            ok () {
                this.$emit('on-ok')
            },
            cancelPrevious () {
                this.$emit('on-cancel-preview')
            }
        },
        filters: {
            arrToWeek (arr) {
                if (arr && arr instanceof Array) {
                    const num = ['一', '二', '三', '四', '五', '六', '日']
                    let week = []
                    arr.forEach((item, index) => {
                        week.push('周' + num[item - 1])
                    })
                    return week.join('，')
                } else {
                    return ''
                }
            },
            arrToString (arr) {
                if (arr !== undefined && arr instanceof Array)
                    return arr.join('，')
                else
                    return ''
            },
            formatJson (json) {
                if (!json)
                    return ''
                else
                    return json.min + ' - ' + json.max
            }
        },
        watch: {
            value: {
                handler (val) {
                    this.publicValue = val
                },
                deep: true
            }
        }
    }
</script>

<style scoped>

</style>