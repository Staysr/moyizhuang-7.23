<template>
    <div>
        <SelectItem id="big_sel" @changetabs="changetabs" v-bind:carstate="carstate"></SelectItem>
        <SliderTable id="big_table" :list='list' :type="datatype"></SliderTable>
    </div>
</template>

<script>
import moment from 'moment'
import SelectItem from '../components/tabSelect/selects-item.vue'
import SliderTable from '../components/slider_table/index.vue'    
import { mapState } from 'vuex'

    
    export default {
        name: 'yesterday',
        computed: { ...mapState(['big_form_result']) },
        props: {
            date: {
                type: String
            }
        },
        data () {
            return {
                list: [],
                datatype: 'big'      
            }
        },
        components: { SelectItem,SliderTable },
        created () {
            this.big_form_result.date = this.date
            this.carstate = this.$store.state.delivery
            this.getdata()
        },
        methods: {
            getdata() {
                this.$http.get('situation/task',{params: this.big_form_result}).then((res)=> {
                    if(res.status == 200) {
                        let list = res.data.data.data
                        list.forEach((res)=> {
                            res.arrival_warehouse_time = moment(res.arrival_warehouse_time).format('hh:mm')
                        })
                        this.list = list
                    }
                })
            },
            changetabs() {
                this.getdata()
            }
        }
    }
</script>

<style lang='less'>
    
</style>