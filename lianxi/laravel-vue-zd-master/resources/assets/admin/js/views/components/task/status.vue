<template>
    <tag  color="lime" v-if="status === 0">司机报价中</tag>
    <tag  color="green" v-else-if="status === 1">选司机中</tag>
    <tag  color="blue" v-else-if="status === 2">选到可用司机</tag>
    <tag  color="cyan" v-else-if="status === 3">客户不选司机</tag>
    <tag  color="volcano" v-else-if="status === 4">过期不选司机</tag>
    <tag  color="gold" v-else-if="status === 5">无司机报价</tag>
    <tag  color="red" v-else-if="status === 6">任务作废</tag>
</template>

<script>
    export default {
        name: "task-status",
        props: {
            status: {
                required: true
            }
        }
    }
</script>

<style scoped>

</style>