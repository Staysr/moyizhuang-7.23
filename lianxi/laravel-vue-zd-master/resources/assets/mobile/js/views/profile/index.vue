<template>
    <div class="main">
        <m-header left="home.index" right="statistics.index">{{$store.getters.headerPrefix}}队员概况</m-header>

        <switch-box v-model="index" @on-index-change="change">
            <switch-item class="team_member_tabs">小B业务</switch-item>
            <switch-item class="team_member_tabs">大B业务</switch-item>
        </switch-box>

        <component :is="curr" class="content"></component>
    </div>
</template>

<script>
    import MHeader from "../../components/header/index";
    import SwitchBox from "../../components/switch/box";
    import SwitchItem from "../../components/switch/item";
    import Small from "./components/small";
    import Big from "./components/big";

    export default {
        name: "detail",
        components: {SwitchItem, SwitchBox, MHeader, Big, Small},
        data(){
            return {
                index: this.$route.params.id || 0,
                curr: '',
                name: ''
            }
        },
        methods: {
            change(index){
                if(index === 0){
                    this.curr = 'Small'
                }else{
                    this.curr = 'Big'
                }
            }
        },
    }
</script>

<style scoped lang="less">
input::-webkit-autofill {
    background: transparent!important;
}
input::-webkit-input-placeholder {
  color: #999;
}
input::-moz-placeholder {
  color: #999;
}
.content{
    box-sizing: border-box;
    height: 100%;
    padding-bottom: 88px;
}
.team_member_tabs {
    font-size: 36px;
}

</style>