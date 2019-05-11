<template>
    <Tag color="red" v-if="status === 0">
        待还款
    </Tag>
    <Tag color="blue" v-else-if="status === 1">
        部分还款
    </Tag>
    <Tag color="green" v-else-if="status === 2">
        已经还款
    </Tag>
    <Tag color="geekblue" v-else-if="status === 3">
        无需还款
    </Tag>
</template>

<script>
    export default {
        name: "bill-repay-status",
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