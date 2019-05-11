<template>
    <Tag color="green" v-if="status === 1">
        奖励
    </Tag>
    <Tag color="red" v-else-if="status === 2">
        罚款
    </Tag>
    <Tag color="blue" v-else-if="status === 3">
        其他
    </Tag>
</template>

<script>
    export default {
        name: "award-status",
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