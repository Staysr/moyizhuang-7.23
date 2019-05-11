<template>
    <div class="tools" :class="{right: right, left: !right}">
       <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "tools",
        props: {
            right: {
                type: Boolean,
                default: false
            }
        }
    }
</script>

<style scoped lang="less">
    /*工具组*/
    .tools {
        width: 58px;
        position: absolute;
        bottom: 20px;
        z-index: 99;
        background: transparent !important;
    }
    .right{
        right: 20px;
    }
    .left{
        left: 20px;
    }
</style>