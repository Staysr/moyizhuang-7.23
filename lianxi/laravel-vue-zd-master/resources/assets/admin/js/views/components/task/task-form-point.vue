<template>
    <Row>
        <Col span="7">
        <place-search-select v-model="publicValue.name"
                             @on-change="change"
                             @pois="(val) => {publicValue.lat = val.location ? val.location.lat : 0; publicValue.lng = val.location ? val.location.lng : 0}">
        
        </place-search-select>
        </Col>
        <Col span="5">
        <Input v-model="publicValue.contacts" @on-change="change" placeholder="联系人" clearable/></Col>&nbsp;
        <Col span="5">
        <Input v-model="publicValue.contact_way" @on-change="change" placeholder="联系方式" clearable/></Col>&nbsp;
    </Row>
</template>

<script>
    import PlaceSearchSelect from '../../../components/map/place-search-select'
    import Emitter           from 'iview/src/mixins/emitter'

    export default {
        components: {PlaceSearchSelect},
        mixins: [Emitter],
        name: 'task-form-point',
        props: {
            value: {
                type: Object,
                required: true
            }
        },
        data () {
            return {
                publicValue: this.value
            }
        },
        methods: {
            change () {
                this.$emit('input', this.publicValue)
                this.dispatch('FormItem', 'on-form-blur', this.publicValue)
            }
        },
        watch: {
            value: {
                handler (val) {
                    this.publicValue = val
                },
                deep: true
            }
        }
    }
</script>

<style scoped>

</style>