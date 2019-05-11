<template>
    <div class="number-range">
        <Input v-model="publicValue.min" number :max="publicValue.max" :step="step" @on-change="blur"></Input>
        <span>-</span>
        <Input v-model="publicValue.max" number :min="publicValue.min" :step="step" @on-change="blur"></Input>
        <span>{{unit}}</span><br/>{{explanation}}
    </div>
</template>

<script>
    import Emitter from 'iview/src/mixins/emitter'

    export default {
        name: 'number-range',
        mixins: [Emitter],
        props: {
            value: {
                type: Object,
                default: () => {
                    return {min: 0, max: 0}
                }
            },
            step: [Number],
            unit: String,
            explanation: String
        },
        data () {
            return {
                publicValue: this.value
            }
        },
        methods: {
            blur () {
                this.$emit('blur', this.publicValue)
                this.dispatch('FormItem', 'on-form-blur', this.publicValue)
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
    .number-range .ivu-input-wrapper {
        display: inline-block;
        width: 60px;
    }
</style>