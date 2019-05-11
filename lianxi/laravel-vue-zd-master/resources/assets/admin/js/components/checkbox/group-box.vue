<template>
    <div class="checkbox-button-group">
        <slot></slot>
    </div>
</template>

<script>
    import Emitter from 'iview/src/mixins/emitter'
    
    export default {
        name: "checkbox-button-group",
        mixins: [Emitter],
        props: {
            value: {
                type: Array,
                default: () => []
            }
        },
        data() {
            return {
                defaultCheck: this.value,
                currentCheck: []
            }
        },
        methods: {
            values() {
                this.currentCheck = this.$children.filter((val) => val.check).map((val) => val.value)
            }
        },
        watch: {
            currentCheck(val) {
                this.$emit('input', val)
                this.$emit('on-change', val)
                this.dispatch('FormItem', 'on-form-blur', val)
            },
            value(val){
                this.defaultCheck = val
                this.$children.forEach((item) => {
                    item.change()
                })
            }
        }
    }
</script>

<style scoped>
.checkbox-button-group{
    display: inline-block;
    font-size: 0px;
    vertical-align: middle;
}
</style>