import names from '../../constants/names'

export default {
  methods: {
    isAdmin () {
      return !!this.$store.state.globalState[names.state.user][names.state.admin]
    },
    toEmployeesTable () {
      this.$router.push({ name: 'employees-table-page' })
    },
    toCompaniesTable () {
      this.$router.push({ name: 'data-table-page' })
    },
    logout () {
      const loggedIn = !!this.$store.state.globalState[names.state.user][names.state.id]
      if (!loggedIn && this.$router.currentRoute.name !== 'sign-in-page') {
        this.$router.push({ path: '/sign-in' })
        return false
      }
      return loggedIn
    }
  }
}
