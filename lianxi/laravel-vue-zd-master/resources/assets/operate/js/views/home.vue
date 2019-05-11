<template>
    <div id="testone">
        <Backheader :title="title" :path='path'></Backheader>
        <Memberlist :list="list" :membertype ='membertype' @leaderid="leaderid"></Memberlist>
    </div>
</template>

<script>
    import Backheader from './components/header/back'
    import Memberlist from './components/memebrlist/index'
    import {mapState} from 'vuex'

    export default {
        components: {Memberlist, Backheader},
        created() {
            this.$http.get('driver/big').then((res) => {
                if (res.status == 200) {
                    this.list = res.data.data
                }
            })
        },
        data() {
            return {
                title: '大队长列表',
                list: [],
                path: '',
                membertype: '大队长'
            }
        },
        methods: {
            leaderid(id) {
                this.$cache.set('userInfo', id);
                this.$router.push({
                    name: 'membermap'
                });
            }
        },
        computed: {
            ...mapState(['id', 'getcycleleader'])
        }
    }
</script>

<style lang="less">

</style>