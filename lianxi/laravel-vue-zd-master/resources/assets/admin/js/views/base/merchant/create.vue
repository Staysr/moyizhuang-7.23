<template>
    <component-modal title="修改商户" :width="1000">
        <Form ref="formCreate" :model="formCreate" :label-width="100" :rules="ruleCreate">
            <Box title="基础信息" form>
                <Detail >
                    <FormItem prop="title" label="商户全称">
                        <Input v-model="formCreate.title" placeholder="商户全称" />
                    </FormItem>
                </Detail>

                <Detail>
                    <FormItem prop="short_name" label="商户简称">
                        <Input v-model="formCreate.short_name" placeholder="商户简称" />
                    </FormItem>
                </Detail>

                <Detail>
                    <FormItem prop="city" label="所属城市">
                        <remote remote-url="category/checkbox" v-model="formCreate.city" :ready="true"
                                :remote="false"></remote>
                    </FormItem>
                </Detail>

                <Detail>
                    <FormItem label="行业" prop="trade">
                        <Input v-model="formCreate.trade" placeholder="行业" />
                    </FormItem>
                </Detail>

                <Detail>
                    <FormItem label="开户银行">
                        <Input v-model="formCreate.bank" placeholder="开户银行" />
                    </FormItem>
                </Detail>

                <Detail>
                    <FormItem label="银行卡号">
                        <Input v-model="formCreate.bank_no" placeholder="银行卡号" />
                    </FormItem>
                </Detail>

                <Detail>
                    <FormItem label="固定电话">
                        <Input v-model="formCreate.telephone" placeholder="固定电话" />
                    </FormItem>
                </Detail>

                <Detail >
                    <FormItem label="合同日期" prop="agreement_start_time">
                        <c-date-picker  :value="[formCreate.agreement_start_time, formCreate.agreement_end_time]"
                                        @on-change="agreement"
                                        type="daterange"
                        ></c-date-picker>
                    </FormItem>
                </Detail>

                <Detail>
                    <FormItem label="是否开票" prop="invoice">
                        <i-switch v-model="formCreate.invoice" :false-value="0" :true-value="1">
                            <span slot="open">开</span>
                            <span slot="close">关</span>
                        </i-switch>
                    </FormItem>
                </Detail>

                <Detail >
                    <FormItem prop="repayment" label="结算方式">
                        <RadioGroup  type="button" size="small" v-model="formCreate.repayment">
                            <Radio :label="1">月结</Radio>
                        </RadioGroup>
                    </FormItem>
                </Detail>

                <Detail >
                    <FormItem prop="repayment_day" label="承诺回款天数">
                        <Input v-model="formCreate.repayment_day" number placeholder="承诺回款天数" />
                    </FormItem>
                </Detail>
            </Box>

            <Box title="业务信息" form>
                <Detail>
                    <FormItem prop="quality_id" label="交付品质经理">
                        <remote remote-url="admin/select"
                                v-model="formCreate.quality_id"
                                :params="{authority_level: 4}"  :ready="true" :remote="false"></remote>
                    </FormItem>
                </Detail>

                <Detail >
                    <FormItem label="客户顾问" prop="advice_id">
                        <remote remote-url="admin/select"
                                v-model="formCreate.advice_id"
                                :params="{authority_level: 1}"  :ready="true" :remote="false"></remote>
                    </FormItem>
                </Detail>

                <Detail >
                    <FormItem label="运作经理" prop="running_id">
                        <remote remote-url="admin/select"
                                v-model="formCreate.running_id"
                                :params="{authority_level: 2}" :ready="true" :remote="false"></remote>
                    </FormItem>
                </Detail>

                <Detail >
                    <FormItem label="启用SOP服务" prop="sop">
                        <i-switch v-model="formCreate.sop"  :false-value="0" :true-value="1">
                            <span slot="open">开</span>
                            <span slot="close">关</span>
                        </i-switch>
                    </FormItem>
                </Detail>
            </Box>

            <Box title="联系方式" form>
                <Detail >
                    <FormItem label="联系人" prop="content.contacts">
                        <Input v-model="formCreate.content.contacts" placeholder="联系人" />
                    </FormItem>
                </Detail>

                <Detail  >
                    <FormItem label="联系手机号" prop="content.contacts_phone">
                        <Input v-model="formCreate.content.contacts_phone" placeholder="联系手机号" />
                    </FormItem>
                </Detail>

                <Detail >
                    <FormItem label="备用电话" prop="content.back_phone">
                        <Input v-model="formCreate.content.back_phone" placeholder="备用电话" />
                    </FormItem>
                </Detail>

                <Detail>
                    <FormItem label="收件地址" prop="content.address">
                        <Input v-model="formCreate.content.address" placeholder="收件地址" />
                    </FormItem>
                </Detail>
            </Box>

            <Box title="账号设置" form>
                <Detail >
                    <FormItem label="商户手机号" prop="user.phone">
                        <Input v-model="formCreate.user.phone" placeholder="商户手机号" number/>
                    </FormItem>
                </Detail>

                <Detail >
                    <FormItem label="商户状态" prop="user.status">
                        <RadioGroup  type="button" size="small" v-model="formCreate.user.status">
                            <Radio :label="1">启用</Radio>
                            <Radio :label="0">禁用</Radio>
                            <Radio :label="2">冻结</Radio>
                        </RadioGroup>
                    </FormItem>
                </Detail>

                <Detail >
                    <FormItem label="密码" prop="user.password">
                        <Input v-model="formCreate.user.password" type="password" placeholder="密码" />
                    </FormItem>
                </Detail>

                <Detail >
                    <FormItem label="确认密码" prop="user.password_confirmation">
                        <Input v-model="formCreate.user.password_confirmation" type="password" placeholder="确认密码" />
                    </FormItem>
                </Detail>
            </Box>
        </Form>

        <div slot="footer">
            <Button type="primary" :loading="loading" @click="createSubmit('formCreate', 'merchants')">创建</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../../components/modal/component-modal";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    import Box from "../../../components/box/index";
    import Detail from "../../../components/detail/index";
    import Remote from "../../../components/select/remote";
    import CDatePicker from "../../../components/date-picker/index";
    import {Validator} from "../../../async-validator/base/merchant/create";

    export default {
        name: "m-create",
        components: {Remote, Detail, Box, ComponentModal, CDatePicker},
        mixins: [component, form],
        data() {
            return {
                formCreate: {content:{}, user: {}, repayment: 1, invoice: 0},
                ruleCreate: Validator(this)
            }
        },
        methods: {
            agreement(val){
                this.formCreate.agreement_start_time = val[0];
                this.formCreate.agreement_end_time = val[1];
            }
        }
    }
</script>

<style scoped>

</style>