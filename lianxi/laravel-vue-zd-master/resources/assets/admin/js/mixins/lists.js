import http from './http'

export default {
    mixins: [http],
    data () {
        return {
            searchForm: {},
            lists: {
                data: {
                    data: [],
                    page: {
                        total: 0,
                        current: 1,
                        page_size: 20
                    }
                },
            },
            component: {
                current: '',
                data: {},
            }
        }
    },
    mounted () {
        this.search()
    },
    methods: {
        search (page = 1) {

        },
        assignmentData (data) {
            this.lists.data.data = data.data
            this.lists.data.page.total = data.total
            this.lists.data.page.current = data.current_page
            this.lists.data.page.page_size = data.per_page
        },
        showComponent (type, data) {
            this.component.current = type
            this.component.data = data
        },
        hideComponent () {
            this.component.current = ''
            this.component.data = {}
            this.search()
        },
        destroyItem (row, url) {
            this.loading = true
            this.$http.delete(url).then((res) => {
                this.search()
            }).catch((res) => {
                this.formatErrors(res)
            }).finally(() => {
                this.loading = false
            })
        },
        request (page) {
            let searchForm = JSON.parse(JSON.stringify(this.searchForm))
            searchForm.page = page
            return searchForm
        }
    }
}