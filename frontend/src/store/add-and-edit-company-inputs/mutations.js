import names from '../../constants/names'

export default {

  [names.mutations.setCompanyName] (state, name) {
    state[names.state.company][names.state.name] = name
  },
  [names.mutations.setCompanyEmail] (state, email) {
    state[names.state.company][names.state.email] = email
  },
  [names.mutations.setCompanyWebSite] (state, webSite) {
    state[names.state.company][names.state.webSite] = webSite
  },
  [names.mutations.setCompanyLogo] (state, file) {
    if (file === null) {
      state[names.state.company][names.state.logo][names.state.logoFile] = null
      state[names.state.company][names.state.logo][names.state.logoUrl] = ''
      return
    }
    state[names.state.company][names.state.logo][names.state.logoFile] = file
    state[names.state.company][names.state.logo][names.state.logoUrl] = URL.createObjectURL(file)
  },
  [names.mutations.setCompanyInputsToDefault] (state) {
    state[names.state.company][names.state.id] = 0
    state[names.state.company][names.state.name] = ''
    state[names.state.company][names.state.email] = ''
    state[names.state.company][names.state.webSite] = ''
    state[names.state.company][names.state.logo][names.state.logoFile] = null
    state[names.state.company][names.state.logo][names.state.logoUrl] = ''
  },
  [names.mutations.setCompanyValuesForEdit] (state, companyData) {
    state[names.state.company][names.state.id] = companyData.id
    state[names.state.company][names.state.name] = companyData.name
    state[names.state.company][names.state.email] = companyData.email
    state[names.state.company][names.state.webSite] = companyData.web_site
    state[names.state.company][names.state.logo][names.state.logoFile] = null
    state[names.state.company][names.state.logo][names.state.logoUrl] = companyData.logo
  }
}
