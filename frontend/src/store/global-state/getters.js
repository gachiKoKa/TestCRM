import names from '../../constants/names'

export default {
  [names.getters.getDefaultRoleId] (state) {
    return state[names.state.allRoles][0].id
  }
}
