<template>
    <Select v-model="model" placeholder="请选择司机状态" @on-change="setValue" clearable filterable style="width: 100px">
        <i-option :value="1" >被选中</i-option>
        <i-option :value="2" >确认上岗</i-option>
        <i-option :value="3" >无责任解约</i-option>
    </Select>
</template>

<script>
    export default {
        name: "driver-select-status",
        props: {
            value: [String, Number]
        },
        data () {
            return {
                model: this.value
            }
        },
        methods: {
            setValue (val) {
                this.$emit('input', val)
            }
        },
        watch: {
            value (val) {
                this.model = val
            }
        }
    }
</script>

<style scoped>

</style>