import names from '../../constants/names'
import PropChecker from '../../services/PropChecker'
import VueCookie from 'vue-cookie'

export default {
  [names.mutations.setUserToGlobalState] (state, dataUser) {
    if (PropChecker.has(dataUser, 'email')) {
      state[names.state.user][names.state.email] = dataUser.email
    }
    if (PropChecker.has(dataUser, 'name')) {
      state[names.state.user][names.state.name] = dataUser.name
    }
    if (PropChecker.has(dataUser, 'id')) {
      state[names.state.user][names.state.id] = dataUser.id
    }
    if (PropChecker.has(dataUser, 'role_id')) {
      state[names.state.user][names.state.roleId] = dataUser.role_id
    }
    if (PropChecker.has(dataUser, 'company_id')) {
      state[names.state.user][names.state.companyId] = dataUser.company_id
    }
  },
  [names.mutations.setRoleToUser] (state, dataRoles) {
    if (PropChecker.has(dataRoles, 'isAdmin')) {
      state[names.state.user][names.state.admin] = dataRoles.isAdmin
    }
    if (PropChecker.has(dataRoles, 'isEmployee')) {
      state[names.state.user][names.state.employee] = dataRoles.isEmployee
    }
  },
  [names.mutations.setAllRoles] (state, allRoles) {
    state[names.state.allRoles] = allRoles
  },
  [names.mutations.setCompanyIdToUser] (state, companyId) {
    state[names.state.user][names.state.companyId] = companyId
  },
  [names.mutations.setAuthConfig] (state, token) {
    state[names.state.authConfig].headers.Authorization = 'Bearer ' + token
    VueCookie.set('token', token)
  }
}
