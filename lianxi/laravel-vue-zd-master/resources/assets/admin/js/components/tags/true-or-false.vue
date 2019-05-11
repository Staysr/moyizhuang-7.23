<template>
    <tag v-if="status" color="green">{{trueValue}}</tag>
    <tag v-else color="red">{{falseValue}}</tag>
</template>

<script>
    export default {
        name: "tags-true-or-false",
        props: {
            status: {
                type: Number,
                required: true
            },
            trueValue: {
                type: String,
                default: '是'
            },
            falseValue: {
                type: String,
                default: '否'
            }
        }
    }
</script>

<style scoped>

</style>