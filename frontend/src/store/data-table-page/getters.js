import names from '../../constants/names'

export default {
  [names.getters.getDefaultCompanyId] (state) {
    if (state[names.state.allCompanies].length > 0) {
      return state[names.state.allCompanies][0].id
    }
    return null
  }
}
