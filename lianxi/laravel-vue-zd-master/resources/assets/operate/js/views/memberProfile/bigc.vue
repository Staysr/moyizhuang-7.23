<template>
    <div id="big_sel">
        <Tabs
        ref='tabsSelect'  
        v-on:dateindex="dateindex" 
        v-bind:tabsitem="tabsitem"
        v-bind:tabIndex=1
        ></Tabs>
    </div>
</template>

<script>
import {mapState} from 'vuex'
import moment from 'moment'
import Tabs from '../components/tabSelect/tabs.vue'
import Today from '../datedata/today.vue'
import Yesterday from '../datedata/yesterday.vue'
import Nextday from '../datedata/nextday.vue'

    export default {
        name: 'big',
        components: { Tabs, Today, Yesterday, Nextday, mapState },
        computed: { ...mapState(['delivery', 'big_form_result','bigdateindex'])
        },
        created () {

            this.tabsitem = [ '昨天', '今天', '明天' ]
            this.big_form_result.supervisor_id = this.$mobile.user().id
            this.$http.get('merchant').then((res)=> {
                this.delivery[0].items = res.data.data
            })
           
        },
        data () {
            return {
                carstate: []
            }
        },
        methods: {
            dateindex(e) {
                if( e == 0 ) {
                    this.$refs.tabsSelect.changeComponent( Yesterday, moment().subtract(1, 'days').format('YYYY-MM-DD'))
                }else if ( e == 1 ) {
                    this.$refs.tabsSelect.changeComponent( Today, moment().format('YYYY-MM-DD'))
                }else if ( e == 2 ) {
                    this.$refs.tabsSelect.changeComponent( Nextday,moment().add(1, 'days').format('YYYY-MM-DD'))
                }
                this.$store.commit('changeindex', e)
            },
        }
    }
</script>

<style lang="less">
    #big_sel {
        .selectItem {
            margin-top: 20px;
        }
        .selResult {
            top: 298px;
        }
        .outermost-layer {
            top: 390px;
        }
        .layout_cover {
            top: 310px;
        } 
    }

</style>