import names from '../../constants/names'
import PropChecker from '../../services/PropChecker'

export default {
  [names.mutations.setUserToGlobalState] (state, data) {
    if (PropChecker.has(data, 'email')) {
      state[names.state.user][names.state.email] = data.email
    }
    if (PropChecker.has(data, 'name')) {
      state[names.state.user][names.state.name] = data.name
    }
    if (PropChecker.has(data, 'id')) {
      state[names.state.user][names.state.name] = data.id
    }
    if (PropChecker.has(data, 'role_id')) {
      state[names.state.user][names.state.roleId] = data.role_id
    }
    if (PropChecker.has(data, 'admin')) {
      state[names.state.user][names.state.admin] = data.admin
    }
    if (PropChecker.has(data, 'employee')) {
      state[names.state.user][names.state.employee] = data.admin
    }
  }
}
