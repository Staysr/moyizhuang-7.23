<template>
    <checkbox-button-group v-model="publicValue" @on-change="change">
        <template v-for="(item, index) in checkboxs">
            <checkbox-button :value="item.id">{{item.name}}</checkbox-button>
        </template>
    </checkbox-button-group>
</template>

<script>
    import Emitter             from 'iview/src/mixins/emitter'
    import http                from '../../mixins/http'
    import CheckboxButtonGroup from '../../components/checkbox/group-box'
    import CheckboxButton      from '../../components/checkbox/index'

    export default {
        name: 'group-checkbox',
        mixins: [Emitter, http],
        components: {CheckboxButtonGroup, CheckboxButton},
        props: {
            value: {
                type: Array,
                default: () => []
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