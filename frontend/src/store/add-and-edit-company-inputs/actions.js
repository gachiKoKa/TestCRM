import names from '../../constants/names'
import axios from 'axios'
import UrlMaker from '../../services/UrlMaker'
import endpoints from '../../constants/endpoints'
import ErrorsAlert from '../../services/ErrorsAlert'

export default {
  [names.actions.addCompany] ({ commit, state, dispatch }) {
    const formData = new FormData()

    if (state[names.state.company][names.state.logo][names.state.logoFile] !== null) {
      formData.append('logo', state[names.state.company][names.state.logo][names.state.logoFile])
    }
    formData.append('name', state[names.state.company][names.state.name])
    formData.append('email', state[names.state.company][names.state.email])
    formData.append('web_site', state[names.state.company][names.state.webSite])
    return new Promise((resolve, reject) => {
      axios.post(UrlMaker.getUrl(endpoints.companies), formData).then(() => {
        dispatch(names.actions.getCompanies)
        resolve()
      }).catch((error) => {
        if (error.response.status !== 400) {
          reject(error.response)
          return
        }
        ErrorsAlert.errorAlert(error.response.data)
        resolve()
      })
    })
  },
  [names.actions.editCompany] ({ dispatch, state }) {
    const id = state[names.state.company][names.state.id]
    const formData = new FormData()

    if (state[names.state.company][names.state.logo][names.state.logoFile] !== null) {
      formData.append('logo', state[names.state.company][names.state.logo][names.state.logoFile])
    }

    formData.append('name', state[names.state.company][names.state.name])
    formData.append('email', state[names.state.company][names.state.email])
    formData.append('web_site', state[names.state.company][names.state.webSite])
    formData.append('_method', 'PATCH')

    return new Promise((resolve, reject) => {
      axios.post(UrlMaker.getUrl(endpoints.companies) + '/' + id, formData).then(() => {
        dispatch(names.actions.getCompanies)
        resolve()
      }).catch((error) => {
        if (error.response.status !== 404 && error.response.status !== 422) {
          reject(error.response)
          return
        }
        ErrorsAlert.errorAlert(error.response.data)
        resolve()
      })
    })
  }
}
