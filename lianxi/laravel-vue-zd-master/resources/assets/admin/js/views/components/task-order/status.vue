<template>
    <Tag color="green" v-if="status === 0">
        未签到
    </Tag>
    <Tag color="cyan" v-else-if="status === 1">
        已签到
    </Tag>
    <Tag color="blue" v-else-if="status === 2">
        配送中
    </Tag>
    <Tag color="geekblue" v-else-if="status === 3">
        配送完成
    </Tag>
    <Tag color="red" v-else-if="status === 4">
        设置不配送
    </Tag>
    <Tag color="volcano" v-else-if="status === 5">
        无责任解约
    </Tag>
    <Tag color="orange" v-else-if="status === 6">
        运营取消
    </Tag>
</template>

<script>
    export default {
        name: "task-order-status",
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