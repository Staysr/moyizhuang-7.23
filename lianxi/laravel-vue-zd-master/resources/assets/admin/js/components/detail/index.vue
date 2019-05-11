<template>
    <Col :span="span" class="box-detail" :offset="offset">
        <div v-if="title !== ''" class="box-detail-title" :style="{width: titleWidth+'px'}">{{title}}：</div>
        <slot></slot>
    </Col>
</template>

<script>
    export default {
        name: "detail",
        props: {
            title: {
                type: String,
                default: ''
            },
            span: {
                type: Number,
                default: 8
            },
            offset: {
                type: Number,
                default: 0
            },
            titleWidth: {
                type: Number,
                default: 80
            }
        }
    }
</script>

<style>
    .box-detail{
        line-height: 26px;
    }
    .box-form .box-detail {
        margin-bottom: 20px;
        line-height: 33px;
    }

    .box-detail > .ivu-form-item {
        margin-bottom: 0px;
        display: inline-block;
    }

    .box-detail .box-detail-title {
        text-align: right;
        display: inline-block;
        overflow:hidden;
        text-overflow:ellipsis;
        white-space:nowrap;
        vertical-align: middle;
    }
</style>