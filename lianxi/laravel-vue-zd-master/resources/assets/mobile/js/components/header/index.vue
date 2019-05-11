<template>
    <header>
        <div class="header-left" @click="leftClick"></div>
        <div class="header-conter">
            <slot></slot>
        </div>
        <div class="header-right" @click="rightClick">
            <div class="header-right-icon" v-if="right"></div>
        </div>
    </header>
</template>

<script>
    // ['left', 'right']
    export default {
        name: "m-header",
        props: {
            left: [String],
            right: [String]
        },
        methods: {
            leftClick(){
                let left = this.left;
                if(left){
                    if(left !== 'close'){
                        this.$router.push({
                            name: left
                        })
                    }else{
                        this.$store.getters.isApp ?
                            this.$store.commit('back') :
                            this.$router.push({
                                name: 'common.choose'
                            });
                    }
                }
                this.$emit('on-click-left')
            },
            rightClick(){
                let right = this.right;
                if(right){
                    this.$router.push({
                        name: right
                    })
                }

                this.$emit('on-click-right')
            },
        }
    }
</script>

<style scoped lang="less">
    header {
        width: 100%;
        height: 88px;
        line-height: 88px;
        position: fixed;
        overflow: hidden;
        display:flex;
        top: 0;
        background-color: #eee;
        box-sizing: border-box;
        .header-left {
            flex-basis: 70px;
            position: relative;
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
                left: 60%;
            }
        }
        .header-conter{
            text-align: center;
            flex: 1;
            font-size: 36px;
            color: #333;
        }
        .header-right {
            flex-basis: 70px;
            position: relative;
            -webkit-tap-highlight-color:transparent;
            .header-right-icon {                     -webkit-tap-highlight-color:transparent;
                /*background-repeat: no-repeat;*/
                width: 38px;    
                height: 40px;
                margin-top: 24px;
                margin-left: 20px;
                background-size: cover;
                background-image: url("/images/mobile/detail.png");
            }
        }
    }
</style>