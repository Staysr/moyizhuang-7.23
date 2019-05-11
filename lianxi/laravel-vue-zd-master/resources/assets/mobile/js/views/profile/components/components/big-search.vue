<template>
    <switch-box @on-children-show="childrenShow">
        <switch-item drop-down>
            商户简称
            <template slot="children">
                <item-box @on-change="(name) => {this.change('merchant_id', name)}">
                    <item-input drop-down name="">
                        全部
                    </item-input>
                    <item-input v-for="(item, index) in merchantLists" :key="index" drop-down :name="item.id">
                        {{item.short_name}}
                    </item-input>
                </item-box>
            </template>
        </switch-item>
        <switch-item drop-down>
            到仓时间
            <template slot="children">
                <item-box @on-change="(name) => {this.change('arrival_warehouse_time', name)}">
                    <item-input drop-down name="">
                        全部
                    </item-input>
                    <item-input drop-down name="00:00-05:59">
                        00:00-05:59
                    </item-input>
                    <item-input drop-down name="06:00-11:59">
                        06:00-11:59
                    </item-input>
                    <item-input drop-down name="12:00-17:59">
                        12:00-17:59
                    </item-input>
                    <item-input drop-down name="18:00-23:59">
                        18:00-23:59
                    </item-input>
                </item-box>
            </template>
        </switch-item>
        <switch-item drop-down>
            出车单状态
            <template slot="children">
                <item-box  @on-change="(name) => {this.change('status', name)}">
                    <item-input drop-down name="">
                        全部
                    </item-input>
                    <item-input drop-down name="0">
                        未签到
                    </item-input>
                    <item-input drop-down name="1">
                        已签到
                    </item-input>
                    <item-input drop-down name="2">
                        配送中
                    </item-input>
                    <item-input drop-down name="3">
                        配送完成
                    </item-input>
                    <item-input drop-down name="4">
                        设置不配送
                    </item-input>
                    <item-input drop-down name="5">
                        无责任解约
                    </item-input>
                    <item-input drop-down name="6">
                        运营取消
                    </item-input>
                </item-box>
            </template>
        </switch-item>
    </switch-box>
</template>

<script>
    import SwitchBox from "../../../../components/switch/box";
    import SwitchItem from "../../../../components/switch/item";
    import ItemBox from "../../../../components/item-list/box";
    import ItemInput from "../../../../components/item-list/index";

    export default {
        name: "big-search",
        components: {ItemInput, ItemBox, SwitchItem, SwitchBox},
        props:{
            value:Object
        },
        data(){
            return {
                publicValue: this.value || {},
                merchantLists:[],
                children: false
            }
        },
        mounted(){
              this.$loading('loading...');
              this.$http.get(`merchant`).then((res) => {
                  this.merchantLists = res.data.data
              }).finally(() => {
                  this.$loading.close();
              })
        },
        methods:{
            change(type, name){
                let val = name;
                if(type === 'arrival_warehouse_time' && name === ''){
                    val = ''
                }else if(type === 'arrival_warehouse_time'){
                    val = name.split('-')
                }
                this.publicValue[type] = val;
                this.$emit('input', this.publicValue)
            },
            childrenShow(is){
                this.children = is
            }
        }
    }
</script>

<style scoped lang="less">

</style>