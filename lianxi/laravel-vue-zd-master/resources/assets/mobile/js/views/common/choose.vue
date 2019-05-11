<template>
    <div>
        <m-header>{{name}}</m-header>

        <item-box @on-change="change">
            <item v-for="(item, index) in lists" :name="item" :key="index">
                {{item.name}}
                <template slot="sub">(大队长)</template>
            </item>
        </item-box>
    </div>
</template>

<script>
    import MHeader from "../../components/header/index";
    import Item from "../../components/item/index";
    import ItemBox from "../../components/item/box";

    export default {
        components: {ItemBox, Item, MHeader},
        data(){
            return {
                lists: [],
                name: ""
            }
        },
        created() {
            this.$loading('loading...');
            this.$http.get('token').then((res) => {
                this.name = res.data.data.name + '列表'
                
            }).finally(() => {
                this.$loading.close();
            })
            this.push()
        },
        methods: {
            change(v){
                this.$store.commit('setUser', v)
                this.$router.push({
                    name: 'home.index'
                })
            },
            push() {
                this.$http.get('driver/big').then((res) => {
                    this.lists = res.data.data
                })
            }
        }
    }
</script>

<style scoped lang="less">

</style>