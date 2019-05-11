<template>
    <div class="bg">   
        <div class="bg_title">
            <img src="../../../../images/team.png" alt="">
            <span>数据汇总</span>
        </div>
        <!--内容区-->
        <div class="big" v-show="type == 0">
            <div>
                <div class="data_group">
                    <p class="num">{{totalmoney}}</p>
                    <p class="data_name">总金额</p>
                </div>
                <div class="data_group">
                    <p class="num">{{total.number}}</p>
                    <p class="data_name">本队人数</p>
                </div>
                <div class="data_group">
                    <p class="num">{{total.order_number}}</p>
                    <p class="data_name">小B接单人数</p>
                </div>
                <div class="data_group">
                    <p class="num">{{total.task_order_number}}</p>
                    <p class="data_name">大B接单人数</p>
                </div>
            </div>
        </div>
        <div class="small" v-show="type == 1">
            <div class="data_group">
                <p class="num">{{totalmoney}}</p>
                <p class="data_name">总金额</p>
            </div>
        </div>
        <!--数据-->
        <div class="data_info">
            <div class="data_left">
                <div class="title">
                    小B业务
                </div>
                <div class="infos">
                    <div class="infos_left">    
                        <p>接单金额</p>
                        <p>接单总数</p>
                        <p>人均金额</p>
                        <p>取消单数</p>
                    </div>
                    <div class="infos_right">
                        <p>{{total.order_complete_fee}}</p>
                        <p>{{total.order_complete_total}}</p>
                        <p>{{small}}</p>
                        <p>{{total.order_cancel_total}}</p>
                    </div>
                </div>
            </div>
            <div class="data_right clearfix">
                <div class="title">
                    大B业务
                </div>
                <div class="infos">
                    <div class="infos_left">    
                        <p>接单金额</p>
                        <p>接单总数</p>
                        <p>人均金额</p>
                    </div>
                    <div class="infos_right">
                        <p>{{total.task_order_fee}}</p>
                        <p>{{total.order_complete_total}}</p>
                        <p>{{big}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'background',
        props: ['total', 'type'],
        watch: {
            small() {
                
            },
        },
        computed: {
            totalmoney() {
                let num = this.total.task_order_fee + this.total.order_complete_fee
                return num ? num : 0
            },
            small() {
                let num = this.total.order_complete_fee / this.total.order_number
                return num ? num : 0                
            },
            big() {
                let num = this.total.task_order_fee / this.total.order_number
                return num ? num : 0
            }
        }
    }
</script>

<style lang="less">
.bg {
    background: #fff;
    padding: 0 20px;
    .bg_title {
        width: 100%;
        font-size: 36px;
        color: #333;
        line-height: 128px;
        span {
            vertical-align: middle;
        }
        img {
            width: 50px;
            height: 50px;
            vertical-align: middle;
        }
    }

    .small {
        width: 100%;
        height: 150px;
        background: url('../../../../images/dataTotalsmall.png') no-repeat center center;
        background-size: cover;
        position: relative;
        .data_group {
            position: absolute;
            text-align: left;
            top: 5px;
            left : 90px;
            .num {
                color: #F32F00;
                font-size: 46px;
            }
            .data_name {
                color: #666;
                font-size: 32px;
            }
        }
    }

    .big {
        width: 100%;
        height: 300px;
        background: url('../../../../images/dataTotal.png') no-repeat center center;
        background-size: cover;
        position: relative;
        .data_group {
            position: absolute;
            text-align: left;
            .num {
                color: #F32F00;
                font-size: 46px;
            }
            .data_name {
                color: #666;
                font-size: 32px;
            }
            &:nth-child(1) {
                top: 10px;
                left: 90px;
            }
            &:nth-child(2) {
                top: 10px;
                right: 130px;
            }
            &:nth-child(3) {
                top: 140px;
                left: 90px;
            }
            &:nth-child(4) {
                top: 140px;
                right: 81px;
            }
        }
    }
    .data_info {
        width: 100%;
        background: #fff;
        height: 308px;
        margin-top: 20px;
        box-sizing: border-box;
        .data_left, .data_right {
            width: 50%;
            height: auto;
            float: left;
            color: #333;

            .title {
                font-size: 34px;
                padding-left: 10px;
            }
            .infos_left, .infos_right {
                padding-left: 10px;
                float: left;
                font-size: 30px;
                color: #333;
                line-height: 58px;
            }
            .infos_right {
                color: #F32F00;
                margin-left: 38px;
            }
        }   

        .data_left {
             &::after {
                content: "";
                height: 180px;
                width: 2px;
                background: #D8D8D8;
                display: inline-block;
                z-index: 30;
                position: absolute;
                left: 354px;
            }
        }
    }
}

</style>