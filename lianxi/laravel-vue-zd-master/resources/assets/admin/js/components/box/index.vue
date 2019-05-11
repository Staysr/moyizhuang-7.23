<template>
    <div class="box" :class="{'box-form': form}">
        <div class="box-header">{{title}}</div>
        <Row class="box-detail">
            <slot></slot>
        </Row>
    </div>
</template>

<script>
    export default {
        name: "box",
        props: {
            title: {
                type: String,
                default: '标题'
            },
            form: [Boolean]
        }
    }
</script>

<style scoped>
    .box {
        margin-bottom: 10px;
        border: 1px solid #dddee1;
        border-radius: 5px;
    }

    .box:last-child {
        margin-bottom: 0px;
    }

    .box-header {
        padding: 8px 48px 8px 16px;
        color: #495060;
        font-size: 12px;
        line-height: 16px;
        border-bottom: 1px solid #dddee1;
    }

    .box-detail {
        padding: 10px;
    }
</style>