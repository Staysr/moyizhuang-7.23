<template>
    <div class="item" @click="onClick">
        <div class="item-center">
            <slot></slot>
            <span class="sub"><slot name="sub"></slot></span>
        </div>
    </div>
</template>

<script>
    import Emitter from '../../mixins/emitter'
    export default {
        name: "item",
        mixins: [Emitter],
        props: {
            name: {
                required: true
            }
        },
        methods: {
            onClick(){
                this.dispatch('item-box', 'on-change', this.name);
            }
        }
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
        line-height: 112px;
        height: 112px;
        font-size: 32px;
        border-bottom: 1px solid #eee;
        &::before{
            height: 20px;
            width: 20px;
            display: inline-block;
            border-radius: 50%;
            background: #07ca61;
            content: "";
            position: absolute;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }
        &::after{
            content: '';
            display: inline-block;
            height: 16px;
            width: 16px;
            border-width: 4px 4px 0 0;
            border-color: #c7c7cc;
            border-style: solid;
            transform: rotate(42deg) translateY(-50%);
            position: absolute;
            top: 50%;
            right: 36px;
        }
        .item-center{
            box-sizing: border-box;
            padding: 0 50px;
            .sub{
                color: #999;
            }
        }

    }
</style>