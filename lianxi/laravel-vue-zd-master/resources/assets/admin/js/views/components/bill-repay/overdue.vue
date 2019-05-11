<template>
    <Tag color="green" v-if="overdue === 0">
        已完成
    </Tag>
    <Tag color="blue" v-else-if="overdue === 1">
        账期内
    </Tag>
    <Tag color="red" v-else-if="overdue === 2">
        账期未还款
    </Tag>
</template>

<script>
    export default {
        name: "bill-repay-overdue",
        props: {
            overdue: {
                type: Number,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>