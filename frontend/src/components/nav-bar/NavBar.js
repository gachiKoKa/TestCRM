import names from '../../constants/names'

export default {
  methods: {
    isAdmin () {
      return !!this.$store.state.globalState[names.state.user][names.state.admin]
    },
    toEmployeesTable () {
      this.$router.push({ name: 'employees-table-page' })
    }
  }
}
