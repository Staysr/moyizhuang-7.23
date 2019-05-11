<template>
    <div class="box" :style="{
    width: this.size+'px',
    height: this.size+'px'
    }" @click="visible = true">
        <img :src="src"/>
        <Modal title="View Image" v-model="visible" >
            <div style="text-align: center;">
                <img :src="src" style="max-width: 500px; max-height: 500px;"/>
            </div>
        </Modal>
    </div>
</template>

<script>
    export default {
        name: "image-box",
        props: {
            src: [String],
            size: {
                type: Number,
                default: 200
            }
        },
        data(){
            return {
                visible: false
            }
        }
    }
</script>

<style scoped>
    .box{
        text-align: center;
        border: 1px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;
        cursor: pointer;
    }
    .box img{
        max-height: 100%;
        max-width: 100%;
    }
</style>