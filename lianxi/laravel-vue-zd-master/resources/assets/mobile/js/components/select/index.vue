<template>
    <div class="select" v-click-outside="onClickOutside">
        <div class="show" @click="() => {this.currentSelected = !this.currentSelected}">
            {{publicValue}}
            <template v-if="publicValue">
                <span v-if="!currentSelected" class="up icon"></span>
                <span v-if="currentSelected" class="down icon"></span>
            </template>
        </div>
        <item-box :value="index" class="select-option" v-show="currentSelected" @on-change="change">
            <item-input v-for="(item, index) in data" :key="index" drop-down :name="item.id">
               {{item.name}}
            </item-input>
        </item-box>
        <div class="mask" v-if="currentSelected"></div>
    </div>
</template>

<script>
    import ItemBox from "../item-list/box";
    import ItemInput from "../item-list/index";
    import {directive as clickOutside} from 'v-click-outside-x';

    export default {
        name: "m-select",
        components: {ItemInput, ItemBox},
        props: {
            data: {
                type: Array
            },
            value: [String, Number]
        },
        directives: {
            clickOutside
        },
        data() {
            return {
                currentSelected: false,
                publicValue: '请选择',
                show:'',
            }
        },
        computed: {
            index(){
                return this.data.findIndex((val) => val.id === this.value)
            }
        },
        mounted(){
            this.change(this.value);
        },
        methods: {
            change(value){
                let data = this.data.find((val) => val.id === value);
                this.currentSelected = false
                if(data){
                    this.publicValue = data.name
                    this.$emit('input', data.id)
                    this.$emit('on-change', data)
                }
            },
            onClickOutside (event) {
                this.currentSelected = false
            } 
        },
        watch: {
            value(val) {
                this.change(val)
            }
        }
    }
</script>

<style scoped lang="less">
    .select {
        .show {
            position: relative;
            .icon {
                border: 13px solid transparent;
                display: inline-block;
                position: absolute;
                right: -58px;
                top: 45%;
                transform: translateX(-20%);
            }
            .up {
                border-top-color: #969696;
            }
            .down {
                border-bottom-color: #969696;
                top: 35%;
            }
            &::before {
                content: "";
                height: 68px;
                width: 237px;
                border: 1px solid #D9D9D9;
                display: inline-block;
                position: absolute;
                left: -45px;
                top: 30px;
            }
        }
        .select-option {
            border-top: 1px solid #eee;
            position: absolute;
            width: 100%;
            left: 0;
            top: 100%;
            box-sizing: border-box;
            z-index: 6;
            height: 530px;
            overflow-x: auto;
        }
        .mask{
            width: 100%;
            height: 1000%;
            position: absolute;
            background-color: #0D0D0D;
            opacity: 0.3;
            z-index:10;
            top: 660px;
            left: 0;
            bottom: 0;
            right: 0;
        }
        
    }
</style>