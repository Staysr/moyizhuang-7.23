<template>
    <Select v-model="model" placeholder="请选择司机类型" @on-change="setValue" clearable filterable>
        <Option :value="0">队员</Option>
        <Option :value="1">小队长</Option>
        <Option :value="2">大队长</Option>
    </Select>
</template>

<script>
    export default {
        name: "driver-type",
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