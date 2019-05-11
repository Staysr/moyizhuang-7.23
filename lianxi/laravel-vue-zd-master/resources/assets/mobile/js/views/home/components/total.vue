<template>
    <div class="total">
        <div class="item">
            <p>队员数</p>
            <span>
                {{total}}
            </span>
        </div>
        <div class="item">
            <p>今天小B业务接单数</p>
            <span>
                {{orderTotal}}
            </span>
        </div>
        <div class="item">
            <p>今天大B业务接单数</p>
            <span>
                {{BigOrderTotal}}
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "total",
        props: {
            total: Number,
            orderTotal: Number,
            BigOrderTotal: Number
        }
    }
</script>

<style scoped lang="less">
    .total{
        background-color: white;
        display: flex;
        .item{
            box-sizing: border-box;
            border-left: 1px solid #d9d9d9;
            height: 150px;
            flex: 1;
            text-align: center;
            &:first-child{
                border-left: none;
            }
            p{
                font-size: 26px;
                color: #999;
                line-height: 28px;
                padding:0 40px;
                margin: 20px 0 0 0;
                height: 56px;
                overflow: hidden;
            }
            span{
                font-size: 46px;
                color: #333;
            }
        }
    }
</style>