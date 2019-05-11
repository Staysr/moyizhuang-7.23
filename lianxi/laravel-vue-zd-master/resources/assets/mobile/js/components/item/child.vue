<template>
    <div class="item" @click="onClick">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "child"
    }
</script>

<style scoped lang="less">
    .item {
        box-sizing: border-box;
        padding: 0 20px;
        background: #fff;
        text-align: left;
        width: 100%;
        position: relative;
        line-height: 88px;
        height: 88px;
        font-size: 32px;
        border-bottom: 1px solid #eee;
    }
</style>