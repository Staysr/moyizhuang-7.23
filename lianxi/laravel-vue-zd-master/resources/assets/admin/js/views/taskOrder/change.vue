<template>
    <component-modal title="更改到仓时间和价格" :width="450" :loading="loading">
        <Form :model="formUpdate" ref="formUpdate" :label-width="80" :rules="rulesUpdate">
            <FormItem label="到仓时间" prop="arrival_warehouse_time">
                <c-date-picker v-model="formUpdate.arrival_warehouse_time"
                               :options="options"
                               type="datetime"></c-date-picker>
            </FormItem>
            <FormItem label="单价" prop="unit_price">
                <InputNumber v-model="formUpdate.unit_price" :step="0.01" :precision="2"></InputNumber>
            </FormItem>
            <FormItem label="备注" prop="remark">
                <Input v-model="formUpdate.remark" type="textarea"/>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" :loading="loading" @click="updateSubmit('formUpdate', `order/change/${data.id}`)">提交
            </Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../components/modal/component-modal";
    import component from "../../mixins/component";
    import Form from "../../mixins/form";
    import CDatePicker from "../../components/date-picker/index";
    import {Validator} from '../../async-validator/taskOrder/change'
    import moment from 'moment'

    export default {
        name: "change",
        components: {CDatePicker, ComponentModal},
        mixins: [component, Form],
        data() {
            return {
                formUpdate: {
                    arrival_warehouse_time: this.data.arrival_warehouse_time,
                    unit_price: parseFloat(this.data.unit_price)
                },
                rulesUpdate: Validator(this),
                options: {
                    disabledDate: (value) => {
                        return !moment(value).isBetween(moment().subtract('day', 2), moment().add('day', 1), 'day')
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>