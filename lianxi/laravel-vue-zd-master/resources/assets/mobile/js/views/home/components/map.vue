<template>
    <div class="map">
        <el-amap ref="map" vid="amap" class="amap" :events="mapEvents" :zoom="14" :center="center">
            <el-amap-marker
                    v-for="(item, index) in data" :key="index"
                    :position="[item.position ? item.position.lng : 0, item.position ? item.position.lat : 0]"
                    :content-render="contentRender"
                    :ext-data="item"
                    :ref="`marker${item.id}`"
                    :vid="item.id"
                    :events="events"
                    :visible="true"
            ></el-amap-marker>
        </el-amap>
        <item-box class="info" v-if="infoShow">
            <item-input>
                <template slot="left">姓名</template>
                <template slot="right" v-if="info.name">{{info.name}}</template>
            </item-input>
            <item-input>
                <template slot="left">车牌</template>
                <template slot="right" v-if="info.car_number">{{info.car_number}}</template>
            </item-input>
            <item-input>
                <template slot="left">出车状态</template>
                <template slot="right" v-if="info.is_work === 1">已出车</template>
                <template slot="right" v-if="info.is_work === 0">未出车</template>
                <!--<template slot="right" v-if="info.is_big_work === 1">大B运单中</template>
                <template slot="right" v-else-if="info.is_work === 0">收车</template>
                <template slot="right" v-else-if="info.work_status === 1">小B运单中</template>
                <template slot="right" v-else-if="info.work_status === 0">空闲中</template>-->
            </item-input>
            <item-input>
                <span @click="push">查看更多</span>
            </item-input>
        </item-box>
    </div>
</template>

<script>
    import VueAMap from 'vue-amap';
    import ItemBox from "../../../components/item/box";
    import ItemInput from "../../../components/item/input";

    Vue.use(VueAMap);

    VueAMap.initAMapApiLoader({
        key: '9798eb91fcd5a3e7b97aff38e9a3ee',
        v: '1.4.4',
        uiVersion: '1.0.11'
    });

    const small = {
        background: `url(${require("../../../../images/small.png")}) 0% 0% / contain no-repeat`,
        height:`80px`,
        width:`60px`,
        color: `white`,
        fontSize: `18px`,
        textAlign: `center`,
        lineHeight: `30px`,
        transform: `scale(.9,.9)`,
        transition: `all 1s`,
        overflow: `hidden`,
        textOverflow:`ellipsis`,
        whiteSpace:`nowrap`
    }
    const big = {
        background: `url(${require("../../../../images/big.png")}) 0% 0% / contain no-repeat`,
        height:`80px`,
        width:`60px`,
        color: `white`,
        fontSize: `18px`,
        textAlign: `center`,
        lineHeight: `30px`,
        transform: `scale(.9,.9)`,
        transition: `all 1s`,
        overflow: `hidden`,
        textOverflow:`ellipsis`,
        whiteSpace:`nowrap`
    }
    const nobill = {
        background: `url(${require("../../../../images/no_bill.png")}) 0% 0% / contain no-repeat`,
        height:`80px`,
        width:`60px`,
        color: `white`,
        fontSize: `18px`,
        textAlign: `center`,
        lineHeight: `30px`,
        transform: `scale(.9,.9)`,
        transition: `all 1s`,
        overflow: `hidden`,
        textOverflow:`ellipsis`,
        whiteSpace:`nowrap`
    }
    const nowork = {
        background: `url(${require("../../../../images/no_work.png")}) 0% 0% / contain no-repeat`,
        height:`80px`,
        width:`60px`,
        color: `white`,
        fontSize: `18px`,
        textAlign: `center`,
        lineHeight: `30px`,
        transform: `scale(.9,.9)`,
        transition: `all 1s`,
        overflow: `hidden`,
        textOverflow:`ellipsis`,
        whiteSpace:`nowrap`
    }

    export default {
        name: "m-map",
        components: {ItemInput, ItemBox},
        props: {
            data: {
                type: Array,
                default: () => []
            }
        },
        data() {
            let self = this
            return {
                infoShow: false,
                info: {},
                markerTarget: null,
                center: [113.939912, 22.523353],
                contentRender(h, {extData}) {
                    if (extData.is_big_work === 1) {
                        return <div class="marker-driver" style={big}>{extData.name}</div>
                    } else if (extData.is_work === 0) {
                        return <div class="marker-driver" style={nowork}>{extData.name}</div>
                    } else if (extData.work_status === 1 && extData.is_work == 1) {
                        return <div class="marker-driver" style={small}>{extData.name}</div>
                    } else if (extData.work_status === 0 && extData.is_work == 1 ) {
                        return <div class="marker-driver" style={nobill}>{extData.name}</div>
                    }
                },
                mapEvents: {
                    touchstart: (e) => {
                        if (this.markerTarget && this.markerTarget.style.transform === 'scale(1.1, 1.1)') {
                            this.markerTarget.style.transform = 'scale(0.9, 0.9)'
                            this.infoShow = false
                        }
                    }
                },
                events:{
                    touchstart: (e) => {

                        self.info = e.target.getExtData();
                        self.center = [e.target.getPosition().lng, e.target.getPosition().lat];
                        self.markerTarget = e.target.getContent()
                        self.style()

                    }
                }
            }
        },
        methods: {
            style() {
                if (this.markerTarget) {
                    if (this.markerTarget.style.transform === ''
                        || this.markerTarget.style.transform === 'scale(0.9, 0.9)') {
                        setTimeout(() => {
                            this.markerTarget.style.transform = 'scale(1.1, 1.1)';
                            this.infoShow = true
                        }, 100);
                    } else {
                        this.markerTarget.style.transform = 'scale(0.9, 0.9)';
                        this.infoShow = false
                    }
                }
            },
            searchresult(item) {
                this.info = item;
                this.center = [item.position.lng, item.position.lat]
                let mar = 'marker'+ item.id
                this.markerTarget = this.$refs[mar][0].$amapComponent.getContent()
                this.style()
            },
            push(){
                let position = this.info.type === 2 ? '(大队长)-队员概况': '(小队长)-队员概况' 
                let name = this.info.name
                this.$router.push({
                    name: 'driver.index',
                    params: {id: this.info.id, name: name + position}
                })
            }
        }
    }
</script>


<style lang="less">
    .map {
        /*box-sizing: border-box;
        padding-bottom: 336px;
        height: 100%;
        position: relative;
        width: 100%;*/
        position: absolute;
        top: 249px;
        left: 0;
        right: 0;
        bottom: 0;
        
        .info {
            width: 100%;
            position: fixed;
            bottom: 0;
            z-index: 9999;
            /*width: 100%;
            position: fiex;
            bottom: 336px;
            left: 0;
            z-index: 9999;*/
        }
    }
.amap-logo{
    z-index: -1;
}
.amap-copyright{
    z-index: -1;
}
</style>

