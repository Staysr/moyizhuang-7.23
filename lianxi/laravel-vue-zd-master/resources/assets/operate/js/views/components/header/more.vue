<template>
    <div>
        <header class="more">
     
            <router-link :to="backpath" class="backroute">
                <div class="arrow">
                    <div class="arrow_right"></div>
                </div>
            </router-link>
            <div class="title">{{title}}</div>
           <router-link :to='detailpath'>
                <img src="../../../../images/detail.png" class="detail" alt="">
           </router-link>

        </header>
    </div>
</template>

<script>
    export default {
        name: 'more',
        props: {
            title: {
                type: String
            },
            detailpath: {
                type: String
            },
            backpath: {
                type: String
            }
        },
        data() {
            return {
                path: '',
                
            }
        },
    }
</script>

<style lang="less">
    .more {
        width: 100%;
        height: 88px;
        text-align: center;
        position: relative;
        overflow: hidden;   
        .title {
            line-height: 90px;
            font-size: 36px;
            color: #333;
            float: left;
            margin-left: 160px;
        }
        
        .backroute {
            float: left;
        }
        .arrow {
            height: 80px;
            width: 50px;
            position: relative;
            bottom: 0;
           
            &::after {
                content: '';
                display: inline-block;
                height: 25px;
                width: 25px;
                border-width: 4px 4px 0 0;
                border-color: #c7c7cc;
                border-style: solid;
                transform: rotate(222deg);
                position: absolute;
                top: 30%;
            }
        }
        .detail {
            width: 38px;
            height: 40px;
            position: absolute;
            /*right: 19px;*/
            left: 93%;
            top: 24px;  
        }
    }
</style>