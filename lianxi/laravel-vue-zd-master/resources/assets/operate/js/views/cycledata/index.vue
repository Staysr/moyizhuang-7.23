<template>
    <div id="cycledata">

        <Backheader :title="title" :path="path"></Backheader>

        <Tabs
            ref='tabsSelect'
            v-bind:tabsitem="tabsitem"
            v-bind:tabIndex=0
            v-on:dateindex="dateindex"
        ></Tabs>
    </div>
</template>

<script>
    import {mapState, mapMutations} from 'vuex'
    import Backheader from '../components/header/back.vue'
    import Tabs from '../components/tabSelect/tabs.vue'
    import Day from './items/day.vue'
    import Week from './items/week.vue'
    import Month from './items/month.vue'
    import Detail from './detail'

    export default {
        name: 'cycledata',
        components: {Tabs, Day, Week, Month, Backheader, mapState, Detail},
        created() {
            this.tabsitem = ['日数据', '周数据', '月数据']
        },
        data() {
            return {
                path: '',
                is: '',
                tabindex: '',
                idnow: '',
                leaderid: '',
                pagetab: '',
                dayindex: ''
            }
        },
        mounted() {
            this.path = '/profile?id=' + this.$route.query.id
        },
        methods: {
            dateindex(e) {
                this.dayindex = e
                if (e == 0) {
                    this.$refs.tabsSelect.changeComponent(Day)
                } else if (e == 1) {
                    this.$refs.tabsSelect.changeComponent(Week)
                } else if (e == 2) {
                    this.$refs.tabsSelect.changeComponent(Month)
                }
            },
            godetail(e) {
                this.$router.push({
                    path: '/cycledatadetail',
                    query: {
                        leaderid: e,
                        id: this.$route.query.id,
                        type: this.dayindex
                    }
                })
            }
        },
        computed: {
            ...mapState(['cycledata', 'cycleleader']),
            title() {
                return this.$cache.get('userInfo').name + '-队员概览'
            },
        },
        watch: {
            cycleleader() {
                if (this.cycleleader != '') {
                    this.idnow = this.cycleleader.small_id
                    this.godetail(this.cycleleader.small_id)
                } else {
                    this.godetail(this.idnow)
                }
            }
        },
    }
</script>

<style lang='less'>
    #cycledata {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        overflow: auto;
        .cycledata_box {
            height: auto;
        }
        .normal {
            top: 1050px;
        }

    }
</style>