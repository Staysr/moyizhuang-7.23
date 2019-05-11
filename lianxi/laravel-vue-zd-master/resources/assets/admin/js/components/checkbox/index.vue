<template>
    <label :for="uuid" class="checkbox-button" :class="{'checkbox-button-checked': check}">
        <input type="checkbox" :value="value" v-model="check" :id="uuid" class="checkbox-button-input"/>
        <slot></slot>
    </label>
</template>

<script>
    import uuid from "../../mixins/uuid";

    export default {
        name: "checkbox-button",
        mixins: [uuid],
        props: {
            value: {
                type: [String, Number],
                required: true
            }
        },
        data() {
            return {
                check: false
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.change()
            })
        },
        methods: {
            change() {
                if (this.$parent.$options.name === 'checkbox-button-group') {
                    if (this.$parent.defaultCheck.indexOf(this.value) !== -1) {
                        this.check = true
                    } else {
                        this.check = false
                    }
                }
            }
        },
        watch: {
            check(val) {
                if (this.$parent.$options.name === 'checkbox-button-group') {
                    this.$parent.values()
                }
            }
        }
    }
</script>

<style scoped>
    .checkbox-button-input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .checkbox-button:first-child {
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
        border-left: 1px solid #dcdee2;
        box-shadow: none;
    }

    .checkbox-button:last-child {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }

    .checkbox-button {
        vertical-align: middle;
        display: inline-block;
        height: 32px;
        line-height: 30px;
        margin: 0;
        padding: 0 15px;
        font-size: 12px;
        color: #515a6e;
        transition: all .2s ease-in-out;
        cursor: pointer;
        border: 1px solid #dcdee2;
        border-left: 0;
        background: #fff;
        position: relative;
    }

    .checkbox-button-checked {
        border-color: #2d8cf0;
        color: #2d8cf0;
        box-shadow: -1px 0 0 0 #2d8cf0;
    }

    .checkbox-button-checked:first-child {
        border-color: #2d8cf0;
        box-shadow: none;
    }
</style>