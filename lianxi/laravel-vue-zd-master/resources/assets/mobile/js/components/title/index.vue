<template>
    <div class="title">
        <div class="icon" :class="icon"></div>
        <div class="name">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "i-title",
        props: {
            icon: String
        }
    }
</script>

<style scoped lang="less">
    .title {
        position: relative;
        line-height: 128px;
        height: 128px;
        width: 100%;
        font-size: 36px;
        color: #333;
        paddding-top: 0;
        background: #fff;
        margin-top: 20px;

        .icon{
            height: 50px;
            width: 50px;
            vertical-align: middle;
            display: inline-block;
            margin-left: 20px;
            background-size: 100% 100%;
        }
        .team{
            background: url("/images/mobile/team.png") no-repeat;
            height: 50px;
            width: 50px;
            vertical-align: middle;
            display: inline-block;
            margin-left: 20px;
            background-size: 100% 100%;
        }
        .team-detail{ 
            background: url("/images/mobile/team-detail.png") no-repeat;
            height: 50px;
            width: 50px;
            vertical-align: middle;
            display: inline-block;
            margin-left: 20px;
            background-size: 100% 100%;
        }
        .name{
            margin-left: 19px;
            vertical-align: middle;
            display: inline-block;
        }
    }
</style>