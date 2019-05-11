<template>
    <div class="main main-body">
        <keep-alive>
            <router-view v-if="$route.meta.keepAlive"></router-view>
        </keep-alive>
        <router-view v-if="!$route.meta.keepAlive"></router-view>
    </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        name: "App",
        computed: {
            ...mapState(['loading']),
        },
        methods: {},
    }
</script>

<style lang="less" scoped>
    @import "../../less/loading";

    @supports (bottom: constant(safe-area-inset-bottom)) {
        body {
            padding-bottom: constant(safe-area-inset-bottom);
            position: relative;
            box-sizing: border-box;
        }
    }

    @media (device-width: 375px) and (device-height: 812px) and (-webkit-min-device-pixel-ratio: 3) {
        @supports (bottom: constant(safe-area-inset-bottom)) {
            body {
                padding-bottom: constant(safe-area-inset-bottom);
                position: relative;
                box-sizing: border-box;
            }
        }
    }

    .main-body {
        padding-top: 88px;
        box-sizing: border-box;
    }
</style>

<style>
    html, body, .main, .scroll {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
    }

    .scroll {
        overflow-y: auto;
    }
</style>