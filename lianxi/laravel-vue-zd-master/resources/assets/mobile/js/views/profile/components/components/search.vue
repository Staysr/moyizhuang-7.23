<template>
    <switch-box @on-children-show="childrenShow">
        <switch-item drop-down>
            出车状态
            <template slot="children">
                <item-box v-model="isWork"  @on-change="(name) => {this.change('is_work', name)}">
                    <item-input drop-down name="">
                        全部
                    </item-input>
                    <item-input drop-down name="0">
                        未出车
                    </item-input>
                    <item-input drop-down name="1">
                        已出车
                    </item-input>
                </item-box>
            </template>
        </switch-item>
        <switch-item drop-down>
            空闲状态
            <template slot="children">
                <item-box v-model="workStatus" @on-change="(name) => {this.change('work_status', name)}">
                    <item-input drop-down name="">
                        全部
                    </item-input>
                    <item-input drop-down name="0">
                        空闲
                    </item-input>
                    <item-input drop-down name="1">
                        小B业务运单中
                    </item-input>
                    <item-input drop-down name="2">
                        大B业务运单中
                    </item-input>
                </item-box>
            </template>
        </switch-item>
        <switch-item drop-down>
            收车原因
            <template slot="children">
                <item-box  v-model="endWork" @on-change="(name) => {this.change('last_end_work', name)}">
                    <item-input drop-down name="">
                        全部
                    </item-input>
                    <item-input drop-down name="下班">
                        下班
                    </item-input>
                    <item-input drop-down name="吃饭">
                        吃饭
                    </item-input>
                    <item-input drop-down name="休息会儿">
                        休息会儿
                    </item-input>
                    <item-input drop-down name="请假">
                        请假
                    </item-input>
                    <item-input drop-down name="管理">
                        管理
                    </item-input>
                    <item-input drop-down name="充电">
                        充电
                    </item-input>
                    <item-input drop-down name="其他">
                        其他
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
        name: "search",
        components: {ItemInput, ItemBox, SwitchItem, SwitchBox},
        props:{
            value:Object
        },
        data(){
            return {
                publicValue: this.value || {},
                endWork: 0,
                workStatus: 0,
                isWork: 0,
                children: false
            }
        },
        methods:{
            change(type, name){
                this.publicValue[type] = name;
                this.$emit('input', this.publicValue)
            },
            childrenShow(is){
                this.children = is
            }
        }
    }
</script>

<style scoped lang="less">
    .mask{
        width: 100%;
        height: 100%;
        position: absolute;
        background-color: #0D0D0D;
        opacity: 0.3;
        margin-top: 90px;
        z-index:8
    }
</style>