import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters([
      'rules'
    ])
  },
  methods: {
    isAuth (name) {
      return this.rules.find((val) => name === val.name)
    }
  }
}