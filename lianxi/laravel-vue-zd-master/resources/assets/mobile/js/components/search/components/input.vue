<template>
    <div class="box">
        <div class="label">
            <div class="icon"></div>
            <div class="input">
                <input v-model="keyword" type="text" placeholder="请输入司机姓名" class="searchInput">
            </div>
            <div class="icon-close" v-if="keyword" @click="remove"></div>
        </div>
        <div class="cancel" @click="cancel">取消</div>
    </div>
</template>

<script>
    export default {
        name: "search-input",
        props: {
            value: {
                type: String
            }
        },
        data(){
            return {
                keyword: ''
            }
        },
        methods: {
            remove(){
                this.keyword = ''
            },
            cancel(){
                this.$emit('on-cancel')
            }
        },
        watch: {
            keyword(value){
                this.$emit('input', value)
            },
            value(value){
                this.keyword = value
            }
        }
    }
</script>

<style scoped lang="less">
.box{
    height: 88px;
    line-height: 88px;
    padding: 10px 100px 10px 10px;
    width: 100%;
    box-sizing: border-box;
    background-color: white;
    position: relative;
    border-bottom: 1px solid #eee;
    .label{
        border-radius: 5px;
        background-color: #eee;
        padding: 10px 10px 10px 58px;
        position: relative;
        .icon{
            position: absolute;
            left: 10px;
            height: 48px;
            width: 48px;
            background-image: url("/images/mobile/search-icon.png");
            background-size: 100% 100%;
        }
        .input{
            width: 100%;
            height: 48px;
            input{
                background-color: transparent;
                background-size: cover;
                vertical-align: middle;
                width: 100%;
                border: 0;
                display: block;
                height: 48px;
                outline: none;
                padding-left: 10px;
                color: #333;
                &::focus{
                    border: 0;
                    outline: none;
                }
            }
        }
        .icon-close{
            position: absolute;
            right: 10px;
            top: 15px;
            height: 38px;
            width: 38px;
            background-image: url("/images/mobile/search-close.png");
            background-size: 100% 100%;
        }
    }
   
    .cancel{
        position: absolute;
        width: 100px;
        top: 0;
        right: 0;
        text-align: center;
        color: #666;
    }
   
}
.searchInput::-webkit-input-placeholder {
    color: #999;
}
.searchInput::-moz-placeholder {
    color: #999;
}
</style>