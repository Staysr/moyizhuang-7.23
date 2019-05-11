export default {
    data(){
        return {
            loading: false
        }
    },
    methods: {
        formatErrors (visible) {
            if (visible && visible.response && visible.response.status === 422) {
                let errors = visible.response.data.errors
                for (let i in errors) {
                    this.error(errors[i].join(','))
                }
            } else if (visible.response) {
                if(visible.response.data.message){
                    this.error(visible.response.data.message)
                }else{
                    this.error(visible.response.data.data.message)
                }
            } else {
                this.error('请求失败！请检查网站配置')
            }
        },
        error (message) {
            this.$Notice.error({
                title: '错误',
                desc: message
            })
        }
    }
}