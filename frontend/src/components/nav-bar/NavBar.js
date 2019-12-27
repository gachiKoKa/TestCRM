import names from '../../constants/names'
import VueCookie from 'vue-cookie'

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
      this.$store.commit(names.mutations.setUserToGlobalState, {
        email: '',
        name: '',
        id: 0,
        role_id: 0,
        company_id: null
      })
      this.$store.commit(names.mutations.setRoleToUser, {
        isAdmin: false,
        isEmployee: false
      })
      this.$store.commit(names.mutations.setAuthConfig, '')
      VueCookie.delete('token')
      this.$router.push({ path: '/sign-in' })
    }
  }
}
