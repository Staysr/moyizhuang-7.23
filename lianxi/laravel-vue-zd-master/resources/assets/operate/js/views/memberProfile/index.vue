<template>
    <div>
        <Moreheader :title="title" :detailpath="detailpath" :backpath="backpath"></Moreheader>

        <div @click="toggle( 'Smallc' )" v-bind:class="{smallone: 'ture' , selected : isTure}">小B业务</div>
        <div @click="toggle( 'Bigc' )" v-bind:class="{bigone: 'ture', selected : !isTure }">大B业务</div>
        <!--查询-->
        <div class="tools">
            <span class="search" @click="goToSearch">
                <img src="../../../images/search.png" alt="">
            </span>
            <span class="goTop" @click="goTop">
                <img src="../../../images/goTop.png" alt="">
            </span>
        </div>
        <components
                :is="is"
                @smallbig="smallbig"
                keep-alive>
        </components>
    </div>
</template>

<script>
    import Moreheader from '../components/header/more.vue'
    import Bigc from './bigc.vue'
    import Smallc from './smallc.vue'
    import {mapState} from 'vuex'

    export default {
        name: 'memberProfile',
        components: {Bigc, Smallc, Moreheader},
        computed: {
            ...mapState(['bigdateindex']),
            title() {
                return this.$cache.get('userInfo').name + '-队员概览'
            },
        },
        created() {
            this.toggle(this.is)
            this.backpath = "/membermap?id=" + this.$mobile.user().id
            this.detailpath = "/cycledata?id=" + this.$mobile.user().id
        },
        data() {
            return {
                is: 'Smallc',
                isTure: '',
                backpath: '',
                detailpath: '',
                list: [],
                searchresult: []
            }
        },
        methods: {
            toggle(item) {
                this.isTure = item == 'Smallc'
                this.is = item
            },
            goTop() {
               if(document.documentElement.scrollTop != 0) {
                    setTimeout(()=> {
                        document.documentElement.scrollTop = 0
                    }, 300)
                }
            },
            smallbig(e) {
                this.list = e
            },
            goToSearch() {
                if (this.is == 'Bigc') {
                    this.$router.push('/search?type=' + this.is + '&&bigpage=' + this.bigdateindex + '&&id=' + this.$mobile.user().id)
                } else {
                    this.$router.push('/search?type=' + this.is + '&&id=' + this.$mobile.user().id)
                }
            }
        },
    }
</script>

<style scoped>
    .smallone, .bigone {
        font-size: 36px;
        color: #333;
        width: 50%;
        float: left;
        text-align: center;
        line-height: 98px;
        background: #fff;
        border-bottom: 1px solid #eee;
    }

    .selected {
        display: inline-block;
        color: #07CA61 !important;
        position: relative;

    }

    .selected::after {
        content: "";
        height: 8px;
        width: 130px;
        background: #07CA61;
        display: inline-block;
        position: absolute;
        bottom: 0;
        left: 123px;
    }

    /*工具组*/
    .tools {
        height: 158px;
        width: 58px;
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 35;
        background: transparent !important;
    }

    .search img, .goTop img {
        height: 68px;
        width: 68px;
        background: transparent !important;
    }

    .search {
        position: absolute;
        top: 0;
        background: transparent !important;
    }

    .goTop {
        position: absolute;
        bottom: 0;
        z-index: 40;
    }

</style>