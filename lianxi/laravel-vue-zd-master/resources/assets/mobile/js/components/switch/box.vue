<template>
    <div class="switch">
        <slot></slot>
    </div>
</template>

<script>
    import  {parentMixin} from '../../mixins/multi-items'
    export default {
        name: "switch-box",
        mixins: [parentMixin]
    }
</script>

<style  lang="less">
    .switch{
        display: flex;
        background-color: white;
        position: relative;
        border-bottom: 1px solid #eee;
        box-sizing: border-box;
        .item{
            flex: 1;
            text-align: center;
            line-height: 88px;
            height: 88px;
            .title{
                font-size: 32px;
            }
        }
        .item-select {
            .title {
                color: #07ca61 !important;
                position: relative;
                &::after {
                    width: 114px;
                    height: 5px;
                    background: #07CA61;
                    content: '';
                    position: absolute;
                    bottom: 2px;
                    left: 50%;
                    -webkit-transform: translateX(-50%);
                    transform: translateX(-50%);
                }
            }
        }
    }
</style>