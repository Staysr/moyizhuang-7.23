<template>
    <Select v-model="model" placeholder="请选择任务类型" @on-change="setValue" clearable filterable style="width: 100px">
        <Option :value="1">主任务</Option>
        <Option :value="2">临时任务</Option>
    </Select>
</template>

<script>
    export default {
        name: "task-type",
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