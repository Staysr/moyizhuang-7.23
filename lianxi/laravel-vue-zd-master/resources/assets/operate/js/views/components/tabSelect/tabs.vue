<template>
    <div class="tabscom">
        <div 
        v-for="(item, index) in tabsitem" 
        @click="toggleItem(index, item)"
        class="tabscomponent" 
        >
            <div :class='{tabSel: index == tabsindex}'>{{item}}</div>
        </div>
        <!--组件跳转页面-->
        <components :is='component' :date="dateChange"></components>
    </div>
</template>

<script>
    export default {
        name: 'tabs',
        props: {
            tabsitem: {
                type: Array
            },
            tabIndex: {
                type: Number
            }
        },
        data () {
            return {
                tabsindex: '',
                component: '',
                dateChange: ''
            }
        },
        created () {
          this.toggleItem(this.tabIndex)
        },
        methods: {
            toggleItem( index, item ) {
                this.tabsindex = index
            },
            changeComponent( com, date ) {
                this.component = com
                this.dateChange = date
            }
        },
        watch: {
            tabsindex() {
                this.$emit('dateindex', this.tabsindex)
            },
            dateChange() {
                return this.dateChange
            }
        }
    }
</script>

<style lang="less">
.tabscom {
    width: 100%;
    height: 98px;
    .tabscomponent {
        width: 100%;
        text-align: center;
        clear: both;
        display: inline;
        z-index: 99;
        div {
            width: 33.333%;
            line-height: 98px;
            font-size: 32px;
            color: #333;
            float: left;
            background: #fff;
        }
        .tabSel {
            display: inline-block;
            color: #07CA61!important;
            position: relative;
            
        }
        .tabSel::after {
            content: "";
            height: 8px;
            width: 73px;
            background: #07CA61;
            display: inline-block;
            position: absolute;
            bottom: 0;
            left: 93px;
        }
    }
} 
</style>