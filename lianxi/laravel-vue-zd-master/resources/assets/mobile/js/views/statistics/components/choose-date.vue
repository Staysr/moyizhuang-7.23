<template>
    <div class="choose-date">
        <div class="left o" @click="add"></div>
        <div class="item">
            {{privateValue}}
        </div>
        <div class="right o" v-if="sub" @click="subtract"></div>
    </div>
</template>

<script>
    import moment from 'moment'
    export default {
        name: "choose-date",
        props: {
            type: String,
            value: Array
        },
        data(){
            return {
                publicValue: [],
                sub: 0
            }
        },
        computed: {
            privateValue(){
                if(this.type === 'Date'){
                    return this.publicValue[0];
                }else if(this.type === 'Week'){
                    return this.publicValue[0] + ' 至 ' + this.publicValue[1];
                }else if(this.type == 'Month')
                    return this.publicValue[0] + ' 至 ' + this.publicValue[1];
            }
        },
        mounted(){
            this.initDate()
        },
        methods:{
            initDate(){
                if(this.type === 'Date'){
                    this.publicValue = this.getDays()
                }else if(this.type === 'Week'){
                    this.publicValue = this.getWeeks();
                }else{
                    this.publicValue = this.getMonth();
                }
                this.$emit('input', this.publicValue)
            },
            getDays(){
                return [
                    moment().subtract(this.sub, 'days').format('YYYY-MM-DD'),
                    moment().subtract(this.sub, 'days').format('YYYY-MM-DD')
                ]
            },
            getWeeks(){
                let subWeek = moment().subtract(2, 'days');
                let start,end;
                if((moment().get('day') || 7) < (subWeek.get('day') || 7)){
                    start = moment().subtract((this.sub + 1) * 7, 'days')
                }else{
                    start = moment().subtract(this.sub * 7, 'days').day(1)
                }

                if(this.sub === 0){
                    end = subWeek
                }else{
                    end = moment(start.toDate()).day(7)
                }

                return [
                    start.format('YYYY-MM-DD'),
                    end.format('YYYY-MM-DD')
                ]
            },
            getMonth(){
                let subWeek = moment().subtract(2, 'days');
                let start,end;
                if((moment().get('date')) < (subWeek.get('date'))){
                    start = moment().subtract((this.sub + 1), 'month')
                }else{
                    start = moment().subtract(this.sub, 'month')
                }

                if(this.sub === 0){
                    end = subWeek
                }else{
                    end = moment(start.toDate()).endOf('month')
                }

                return [
                    start.format('YYYY-MM-01'),
                    end.format('YYYY-MM-DD')
                ]
            },
            add(){
                this.sub += 1
                this.initDate()
            },
            subtract(){
                if(this.sub === 0){
                    return ;
                }
                this.sub -= 1
                this.initDate()
            }
        },
        watch:{
            type(){
                this.sub = 0
                this.initDate()
            }
        }
    }
</script>

<style scoped lang="less">
.choose-date{
    height: 88px;
    line-height: 88px;
    font-size: 34px;
    text-align: center;
    position: relative;
    padding: 0 50px;
    box-sizing: border-box;
    background-color: #eee;
    .o{
        position: absolute;
        height: 44px;
        width: 44px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 30;
        background-size: 100% 100%;
    }
    .left{
        left: 20px;
        background-image: url("/images/mobile/circleleft.png");
    }
    .right{
        right: 20px;
        background-image: url("/images/mobile/circleright.png");
    }
    .item{

    }
}
</style>