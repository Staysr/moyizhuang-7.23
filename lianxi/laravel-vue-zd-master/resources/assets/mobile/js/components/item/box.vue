<template>
    <div @on-change="onChange">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "item-box",
        methods: {
            onChange(v){
                this.$emit('on-change', v)
            }
        }
    }
</script>

<style scoped>

</style>