import names from '../../constants/names'
import companiesGetters from '../../store/data-table-page/getters'
import rolesGetters from '../../store/global-state/getters'

export default {
  [names.mutations.setEmployeeName] (state, name) {
    state[names.state.employee][names.state.name] = name
  },
  [names.mutations.setEmployeeEmail] (state, email) {
    state[names.state.employee][names.state.email] = email
  },
  [names.mutations.setEmployeePassword] (state, password) {
    state[names.state.employee][names.state.password] = password
  },
  [names.mutations.setEmployeePasswordConfirmation] (state, passwordConfirmation) {
    state[names.state.employee][names.state.passwordConfirm] = passwordConfirmation
  },
  [names.mutations.setEmployeeCompanyId] (state, companyId) {
    state[names.state.employee][names.state.companyId] = companyId
  },
  [names.mutations.setEmployeeRoleId] (state, roleId) {
    state[names.state.employee][names.state.roleId] = roleId
  },
  [names.mutations.setEmployeeInputsToDefault] (state) {
    state[names.state.employee][names.state.id] = 0
    state[names.state.employee][names.state.name] = ''
    state[names.state.employee][names.state.email] = ''
    state[names.state.employee][names.state.password] = ''
    state[names.state.employee][names.state.passwordConfirm] = ''
    state[names.state.employee][names.state.companyId] = companiesGetters[names.getters.getDefaultCompanyId]
    state[names.state.employee][names.state.roleId] = rolesGetters[names.getters.getDefaultRoleId]
  },
  [names.mutations.setUserValueForEdit] (state, user) {
    state[names.state.employee][names.state.id] = user.id
    state[names.state.employee][names.state.name] = user.name
    state[names.state.employee][names.state.email] = user.email
    state[names.state.employee][names.state.password] = ''
    state[names.state.employee][names.state.passwordConfirm] = ''
    state[names.state.employee][names.state.companyId] = null
    if (user.company !== null) {
      state[names.state.employee][names.state.companyId] = user.company.id
    }
    state[names.state.employee][names.state.roleId] = user.role.id
  }
}
