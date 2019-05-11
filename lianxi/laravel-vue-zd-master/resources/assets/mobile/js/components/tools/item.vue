<template>
    <span class="item" :class="icon" @click="onClick"></span>
</template>

<script>
    export default {
        name: "tools-item",
        props: {
            icon: [String]
        },
        methods: {
            onClick(){
                this.$emit('on-click')
            }
        }
    }
</script>

<style scoped lang="less">
    .item{
        height: 68px;
        width: 68px;
        display: block;
        margin-bottom: 10px;
        background-size: 100% 100%;
        &:last-of-type{
            margin-bottom: 0px;
        }
    }
    .search{
        background-image: url("/images/mobile/search.png");
    }
    .top{
        background-image: url("/images/mobile/goTop.png");
    }
    .position{
        background-image: url("/images/mobile/position.png");
    }
    .renovate{
        background-image: url("/images/mobile/renovate.png");
    }
    .phonecall {
         background-image: url("/images/mobile/phonecall.png");
    }
</style>