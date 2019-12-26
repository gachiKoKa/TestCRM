import names from '../../constants/names'

export default {
  [names.mutations.setCompanies] (state, companyData) {
    state[names.state.companies] = companyData
  },
  [names.mutations.setAllCompanies] (state, companies) {
    state[names.state.allCompanies] = companies
  }
}
