<template>
    <RadioGroup v-model="publicValue" @on-change="change" type="button">
        <template v-for="(item, index) in checkboxs">
            <Radio :value="item.id" :label="item.id">{{item.title}}</Radio>
        </template>
    </RadioGroup>
</template>

<script>
    import Emitter from 'iview/src/mixins/emitter'
    import http    from '../../mixins/http'

    export default {
        name: 'group-radio',
        mixins: [Emitter, http],
        props: {
            value: {
                type: Number
            },
            url: {
                type: String,
                required: true,
                default: ''
            }
        },
        data () {
            return {
                publicValue: this.value,
                checkboxs: []
            }
        },
        mounted () {
            this.$nextTick(function () {
                this.loading = true
                this.$http.get(this.url).then((res) => {
                    this.checkboxs = res.data.data
                }).finally(() => {
                    this.loading = false
                })
            })
        },
        methods: {
            change (val) {
                this.$emit('input', this.publicValue)
                this.dispatch('FormItem', 'on-form-blur', this.publicValue)
            }
        },
        watch: {
            value (val) {
                this.publicValue = val
            }
        }
    }

</script>

<style scoped>

</style>