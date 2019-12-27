import names from '../../constants/names'

export default {
  computed: {
    pagination () {
      return this.$store.state.pagination[names.state.pagination]
    },
    currentPage () {
      return this.$store.state.pagination[names.state.currentPage]
    }
  },
  methods: {
    redirect (item) {
      if (!item.disabled) {
        this.$store.commit(names.mutations.setCurrentPage, item.toPage)
        this.$store.dispatch(this.$store.state.pagination[names.state.action])
      }
    }
  }
}
