import names from '../../constants/names'

export default {
  beforeCreate () {
    this.$store.dispatch(names.actions.getAllCompanies)
    const roles = this.$store.state.globalState[names.state.allRoles]
    const currentRole = this.$store.state.addAndEditEmployeeInputs[names.state.employee][names.state.roleId]
    if (roles.length > 0 && currentRole === 0) {
      this.$store.commit(names.mutations.setEmployeeRoleId, roles[0].id)
    }
  },
  computed: {
    name: {
      get () {
        return this.$store.state.addAndEditEmployeeInputs[names.state.employee][names.state.name]
      },
      set (value) {
        this.$store.commit(names.mutations.setEmployeeName, value)
      }
    },
    email: {
      get () {
        return this.$store.state.addAndEditEmployeeInputs[names.state.employee][names.state.email]
      },
      set (value) {
        this.$store.commit(names.mutations.setEmployeeEmail, value)
      }
    },
    password: {
      get () {
        return this.$store.state.addAndEditEmployeeInputs[names.state.employee][names.state.password]
      },
      set (password) {
        this.$store.commit(names.mutations.setEmployeePassword, password)
      }
    },
    password_confirmation: {
      get () {
        return this.$store.state.addAndEditEmployeeInputs[names.state.employee][names.state.passwordConfirm]
      },
      set (password) {
        this.$store.commit(names.mutations.setEmployeePasswordConfirmation, password)
      }
    },
    companies () {
      return this.$store.state.dataTablePage[names.state.allCompanies]
    },
    company: {
      get () {
        return this.$store.state.addAndEditEmployeeInputs[names.state.employee][names.state.companyId]
      },
      set (value) {
        this.$store.commit(names.mutations.setEmployeeCompanyId, value)
      }
    },
    roles () {
      return this.$store.state.globalState[names.state.allRoles]
    },
    role: {
      get () {
        return this.$store.state.addAndEditEmployeeInputs[names.state.employee][names.state.roleId]
      },
      set (value) {
        this.$store.commit(names.mutations.setEmployeeRoleId, value)
      }
    }
  }
}
