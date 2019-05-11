<template lang="html">
    <div>
        <Card>
            <p slot="title">招司机</p>
            <div>
                <keep-alive :exclude="exclude">
                    <component v-bind:is="current"
                               v-model="formCreate"
                               :config="taskConfig"
                               :extra="extra"
                               @on-next="next"
                               @on-previous="previous"
                               @on-ok="ok"
                               @on-preview="preview"
                               @on-cancel-preview="cancelPreview">
                    
                    </component>
                </keep-alive>
            </div>
        </Card>
    </div>
</template>

<script>
    import form               from '../../mixins/form'
    import http               from '../../mixins/http'
    import component          from '../../mixins/component'
    import CreatePreviousStep from './create/create-previous-step'
    import CreateNextStep     from './create/create-next-step'
    import CreatePreview      from './create/create-preview'

    export default {
        name: 'create',
        mixins: [form, http, component],
        components: {
            CreatePreview,
            CreateNextStep,
            CreatePreviousStep
        },
        data () {
            return {
                current: 'CreatePreviousStep',
                exclude: 'create-preview',
                config: this.$store.getters.cache('config'),
                taskConfig: {},
                extra: {},
                formCreate: {
                    is_back: 0,
                    distance_json: {},
                    send_time: [],
                    goods_volume: {},
                    goods_weight: {},
                    goods_num: {},
                    back_bill: 0,
                    receipt: {
                        type: '',
                        recipient: '',
                        phone: '',
                        address: '',
                        express: ''
                    },
                    unit_price: {},
                    is_delivery: 0,
                    dispatching: [],
                    choose_driver_end_time: '',
                    carry_type: 0,
                    carry: {
                        textarea: '',
                        is_worker: 0,
                        is_loading: 0,
                        is_unloading: 0
                    },
                    other: {
                        is_remove_seat: 0,
                        is_trolley: 0,
                        is_tail_plate: 0,
                        is_extinguisher: 0,
                        is_lock: 0,
                        other_require: ''
                    },
                    supply: [],
                    welfare: [],
                    is_show: 0
                }
            }
        },
        mounted () {
            this.setType()
            this.copy()
            this.setConfig()
            this.setTaskConfig()
        },
        methods: {
            setType () {
                this.$set(this.formCreate, 'type', Number(this.$route.query.type) || '')
            },
            copy () {
                let id = this.$route.params.id
                if (id)
                    this.$http.get(`task/copy/${id}`).then((res) => {
                        let data = this.formCreate = res.data.data
                        this.extra = {
                            supply: data.supply[data.supply.length - 1] || '',
                            welfare: data.welfare[data.welfare.length - 1] || ''
                        }
                    })
            },
            setConfig () {
                if (this.config.length === 0) {
                    if (!this.$store.getters.cacheLock('config')) {
                        this.$http.get(`config/index`).then((res) => {
                            this.$store.commit('setCacheData', {
                                key: 'config',
                                data: res.data.data
                            })
                            this.config = res.data.data
                        }).catch((err) => {
                            this.config = {}
                            this.formatErrors(err)
                        })
                    } else {
                        setTimeout(() => {
                            this.config = this.$store.getters.cache('config')
                        }, 2000)
                    }
                }
            },
            setTaskConfig () {
                let config = this.config
                if (this.formCreate.type === 1)
                    this.taskConfig = {
                        earliest_arrival_time: config.master_driver_reach_earliest_time,
                        earliest_quote_time: config.master_driver_quote_latest_time,
                        choose_driver_latest_time: config.change_master_driver_latest_time_before_work
                    }
                if (this.formCreate.type === 2)
                    this.taskConfig = {
                        earliest_arrival_time: config.temp_driver_reach_earliest_time,
                        earliest_quote_time: config.temp_driver_quote_earliest_time,
                        choose_driver_latest_time: config.change_temp_driver_latest_time_before_work
                    }
            },
            objToArr (obj) {
                if (!(obj instanceof Array)) {
                    let arr = []
                    Object.keys(obj).forEach((item, index) => {
                        arr.push(obj[index])
                    })
                    return arr
                }
                return false
            },
            go (name, params) {
                this.$router.push({name: name, params: params})
            },
            next () {
                if (this.current === 'CreatePreviousStep')
                    this.current = 'CreateNextStep'
            },
            previous () {
                if (this.current === 'CreateNextStep')
                    this.current = 'CreatePreviousStep'
            },
            ok () {
                this.loading = true
                this.$http.post('task/create', this.formCreate).then((res) => {
                    this.$Message.success(res.data.message)
                    this.change(false)
                    this.go('task.lists')
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally(() => {
                    this.loading = false
                })
            },
            preview () {
                if (this.current === 'CreateNextStep')
                    this.current = 'CreatePreview'
            },
            cancelPreview () {
                if (this.current === 'CreatePreview')
                    this.current = 'CreateNextStep'
            }
        },
        watch: {
            'formCreate.type' (val) {
                this.setTaskConfig()
            },
            config (val) {
                this.setTaskConfig()
            },
            'formCreate.dispatching' (val) {
                this.formCreate.dispatching = this.objToArr(val) || val
            },
            'formCreate.welfare' (val) {
                this.formCreate.welfare = this.objToArr(val) || val
            }
        }
    }
</script>

<style lang="scss">

</style>
