<template>
    <router-view></router-view>
</template>

<script>

  export default {
    name: "app",
  }
</script>

<style lang='less'>
    @import '~vux/src/styles/reset.less';
    body{ background: #eee; }
    input, botton { border: 0;-webkit-tap-highlight-color:transparent;outline: none; -webkit-appearance:none; border-color: transparent; box-shadow: 0 0 0 rgba(0, 0, 0, .1) }
    bottom:foucs { -webkit-appearance:none }
    body{ background: #eee; }
   
    .clearfix::after {height: 0;content: "";clear: both;visibility: hidden;display: inline-block;}
    .clearfix {zoom: 1;}
    
    .weui-toast__content {
        font-size: 28px!important;
        line-height: 60px!important;
    }
    ul,li {
        list-style: none;
        text-decoration: none;
        text-decoration-line: none;
        padding: none;
    }
</style>