<template>
    <DatePicker :type="type"
                :format="format"
                :options="options"
                placement="bottom-end"
                placeholder="选择时间"
                v-model="sValue"
                @on-change="change"
                :readonly="readonly"
                :split-panels="panels"
                transfer>
    
    </DatePicker>
</template>

<script>
    import { oneOf } from 'iview/src/utils/assist'
    import Emitter   from 'iview/src/mixins/emitter'
    import moment    from 'moment'

    export default {
        name: 'c-date-picker',
        mixins: [Emitter],
        props: {
            value: {
                type: [Date, String, Array]
            },
            type: {
                validator (value) {
                    return oneOf(value, ['year', 'month', 'date', 'daterange', 'datetime', 'datetimerange'])
                },
                default: 'date'
            },
            format: String,
            options: Object,
            readonly: {
                type: Boolean,
                default: false
            },
            panels: {
                type: Boolean,
                default: false
            },
            customize: {
                type: Boolean,
                default: false
            }
        },
        data () {
            return {
                sValue: this.value
            }
        },
        methods: {
            change (format, date) {
                this.$emit('on-change', format)
                this.$emit('input', format)
                this.$emit('on-change', format)
                this.dispatch('FormItem', 'on-form-blur', format)
            }
        },
        watch: {
            value (val) {
                if (this.customize && val !== undefined) {
                    if (moment(val[1]).format('HH:mm:ss') === '00:00:00') {
                        val[1] = moment(val[1]).format('YYYY-MM-DD') + ' 23:59:59'
                    }
                }
                this.sValue = val
            }
        }
    }
</script>

<style scoped>

</style>