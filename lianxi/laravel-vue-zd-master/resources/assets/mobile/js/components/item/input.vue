<template>
    <div class="item-input" :class="{'item-input-mini': mini}">
        <span class="left">
            <slot name="left"></slot>
        </span>
        <slot></slot>
        <span class="right">
            <slot name="right"></slot>
        </span>
    </div>
</template>

<script>
    export default {
        name: "item-input",
        props: {
            mini: Boolean
        }
    }
</script>

<style scoped lang="less">
.item-input{
    line-height: 88px;
    height: 88px;
    width: 100%;
    border-right: 1px solid transparent;
    border-bottom: 1px solid #eee;
    background-color: white;
    box-sizing: border-box;
    padding-left: 20px;
    padding-right: 20px;
    font-size: 30px;
    text-align: center;
    color: #999;
    .left {
        color: #999;
        float: left;
        max-width: 35%;
        white-space:nowrap;
        overflow: hidden;
    }
    .right {
        color: #333;
        float: right;
        max-width: 65%;
        white-space: auto;
        overflow: hidden;
    }
    .now_position{
        text-align: left;
    }
    &:last-child {
        border-bottom: 1px solid transparent;
    }
}
.item-input-mini{
    font-size: 28px;
    line-height: 68px;
    height: 68px;
    border-bottom: 1px solid transparent;
}
</style>