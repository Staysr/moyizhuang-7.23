<template>
    <div>
        <header class="back">
            <router-link :to="path">
                <div class="title">{{title}}</div>
            </router-link>
        </header>
    </div>
</template>

<script>
    export default {
        name: 'back',
        props: {
            title: {
                type: String
            },
            path: {
                type: String
            }
        },
        data() {
            return {
                
            }
        },
        
    }
</script>

<style lang="less">
    .back {
        width: 100%;
        text-align: center;
        .title {
            line-height: 90px;
            font-size: 36px;
            color: #333;
            position: relative;
            &::after {
                display: inline-block;
                content: " ";
                height: 25px;
                width: 25px;
                border-width: 4px 4px 0 0;
                border-color: #c7c7cc;
                border-style: solid;
                transform: rotate(222deg);
                position: absolute;
                left: 30px;
                top: 38%;
            }
        }
    }
</style>