<template>
    <div class="smallc">
        
        <SelectItem id="small_sel" v-bind:carstate="carstate" @changetabs="changetabs"
        ></SelectItem>
        <SliderTable id="small_table" :list="list" :type="type" :showleader="showleader" @smallid="smallid"></SliderTable>

    </div>
</template>

<script>
import SelectItem from '../components/tabSelect/selects-item.vue'
import SliderTable from '../components/slider_table/index.vue'
import {mapState} from 'vuex'

    export default {
        name: 'smallc',
        components: { SelectItem,SliderTable},
        data () {
            return {
                carstate: [],
                type: '' ,
                form: {
                    last_end_work: '',
                    is_work: '',
                    work_status: '',
                    supervisor_id: '',
                    id: ''
                },
                list: [],
                isshow: false,
                showleader: true
            }
        },
        props: ['searchresult','searchresult'],
        computed: {
          ...mapState(['formresult','supervisorid'])  
        },
        created () {
            //选项页面
            this.carstate = this.$store.state.carstate
            this.type = 'small'
            this.form.supervisor_id = this.supervisorid
            // this.getdata()
        },
        methods: {
            getdata() {
                this.$http.get('/situation', {params: this.form}).then((res)=> {
                    this.list = res.data.data.data
                    this.$emit('smallbig',this.list)
                })  
            },
            changetabs(item) {
                this.form.is_work = this.formresult.is_work
                this.form.work_status = this.formresult.work_status
                this.form.last_end_work = this.formresult.last_end_work
                this.getdata()
            },
            smallid(e) {
                
            }
        },
        watch: {
            supervisorid() {
                
                this.form.supervisor_id = this.supervisorid.id
                this.getdata()
               
            }
        }
    }
</script>

<style lang="less">
.smallc {
   
    .outermost-layer {
        top: 295px;
    }

    .layout_cover {
       top: 278px;
    }
}
#small_sel {
    .selResult {
        top: 186px;
    }
}
#small_table {
    .left, .right {
    }
}
</style>