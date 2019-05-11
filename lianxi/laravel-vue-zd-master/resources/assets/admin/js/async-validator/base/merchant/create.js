export const Validator = (data) => {
    return {
        title: [
            {
                required: true,
                trigger: "blur",
                message: "商户全称必须填写"
            }
        ],
        short_name: [
            {
                required: true,
                trigger: "blur",
                message: "商户简称必须填写"
            }
        ],
        city: [
            {
                required: true,
                trigger: "change",
                type: "number",
                message: "城市必须选择"
            }
        ],
        agreement_start_time:[
            {
                required: true,
                trigger: 'blur',
                message: "合同日期必须填写"
            }
        ],
        invoice: [
            {
                required: true,
                trigger: "blur",
                type:"number",
                message:"请选择"
            }
        ],
        repayment: [
            {
                required: true,
                trigger: "blur",
                type:"number",
                message:"请选择"
            }
        ],
        repayment_day: [
            {
                required: true,
                trigger: "blur",
                type:"number",
                message:"必须填写"
            }
        ],
        quality_id: [
            {
                required: true,
                trigger: "blur",
                type:"number",
                message:"必须填写"
            }
        ],
        advice_id: [
            {
                required: true,
                trigger: "blur",
                type:"number",
                message:"必须填写"
            }
        ],
        sop: [
            {
                required: true,
                trigger: "blur",
                type:"number",
                message:"必须填写"
            }
        ],
        "content.contacts": [
            {
                required: true,
                trigger: "blur",
                message:"必须填写"
            }
        ],
        "content.contacts_phone": [
            {
                required: true,
                trigger: "blur",
                message:"必须填写"
            }
        ],
        "content.address": [
            {
                required: true,
                trigger: "blur",
                message:"必须填写"
            }
        ],
        "user.phone": [
            {
                required: true,
                trigger: "blur",
                type: "number",
                message:"必须填写"
            }
        ],
        "user.status": [
            {
                required: true,
                trigger: "blur",
                type: "number",
                message:"必须填写"
            }
        ],
        "user.password": [
            {
                trigger: "blur",
                required: true,
                message:"必须填写"
            }
        ],
        "user.password_confirmation": [
            {
                trigger: "blur",
                required: true,
                // message:"必须填写",
                validator: (rule, value, callback) =>{
                    if(data.formCreate.user.password !== '' && data.formCreate.user.password !== value){
                        callback(Error('两次密码不相同！'))
                    }
                    callback()
                }
            }
        ]
    }
};