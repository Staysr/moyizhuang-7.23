<template>
    <tag  color="warning" v-if="status === 0">无司机</tag>
    <tag  color="default" v-else-if="status === 1">被选中</tag>
    <tag  color="primary" v-else-if="status === 2">确认上岗</tag>
    <tag  color="success" v-else-if="status === 3">任务完成</tag>
    <tag  color="error" v-else-if="status === 4">任务取消</tag>
    <tag  color="error" v-else-if="status === 5">无责任解约</tag>
</template>

<script>
    export default {
        name: "task-driver-status",
        props: {
            status: {
                type: Number,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>