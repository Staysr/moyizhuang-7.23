<template>
    <div>
        <div class="layout testone">
                <!--箭头方向要更改-->
            <ul class="testmeber">
                <li v-for="item in list" @click="goMemberMap(item)">
                    <p style="display: inline-block">
                        <span>{{item.name}}</span>
                        <span>({{membertype}})</span>
                    </p>
                    <img src="../../../../images/leftarrow.png" alt="">
                </li> 
            </ul>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex'
    export default {
        name: 'memberlist',
        props: ['list', 'membertype'],
        computed: {...mapState(['cycleleader'])},
        methods: {
            goMemberMap( item ) {
                let memid = item.small_id
                if(memid == undefined) {
                    this.$emit('leaderid', item)
                }else {
                    if(item.small_id == this.cycleleader.small_id) {
                        this.$store.commit('getcycleleader', item)
                    }else if (item.small_id != this.cycleleader) {
                        this.$store.commit('getcycleleader', item)
                    }
                }
            },   
        },
    }
</script>

<style lang='less'>
    
.layout .testmeber {
    list-style: none;
    padding: 0 20px;
    background: #fff;
    text-align: left;

 li {
    width: 100%;
    border-bottom: 1px solid #D9D9D9;
    position: relative;
}
li a {
    display: inline-block;
    width: 100%;
    height: auto;
}
li::before {
    height: 20px;
    width: 20px;
    display: inline-block;
    border-radius: 50%;
    background: #07CA61;
    content: "";
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}
 li p {
    display: inline-block;
    margin-left: 50px;
    
}
li p span {
    font-size: 32px;
    line-height: 112px;
    color: #333;
}
li p span:last-child {
    color: #999;
}
 li img {
    width:16.5px;
    height: 28px;
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
}
li:first-of-type {
       border-right: none;
   }
}
</style>