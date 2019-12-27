import names from '../../constants/names'
import axios from 'axios'
import UrlMaker from '../../services/UrlMaker'
import endpoints from '../../constants/endpoints'
import PropChecker from '../../services/PropChecker'
import ErrorsAlert from '../../services/ErrorsAlert'

export default {
  [names.actions.getCompanies] ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get(UrlMaker.getUrl(endpoints.companies)).then((response) => {
        if (PropChecker.hasData(response)) {
          commit(names.mutations.setCompanies, response.data)
        }
        resolve()
      }).catch((error) => {
        reject(error.response)
      })
    })
  },
  [names.actions.deleteCompany] ({ dispatch }, id) {
    return new Promise((resolve, reject) => {
      axios.delete(UrlMaker.getUrl(endpoints.companies) + '/' + id).then(() => {
        dispatch(names.actions.getCompanies)
        resolve()
      }).catch((error) => {
        if (error.response.status !== 422) {
          reject(error.response.data)
          return
        }
        ErrorsAlert.errorAlert(error.response.data)
        resolve()
      })
    })
  },
  [names.actions.getAllCompanies] ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get(UrlMaker.getUrl(endpoints.allCompanies)).then((response) => {
        if (PropChecker.hasData(response)) {
          commit(names.mutations.setAllCompanies, response.data)
          if (response.data.length > 0) {
            commit(names.mutations.setEmployeeCompanyId, response.data[0].id)
          }
        }
        resolve()
      }).catch((error) => {
        reject(error)
      })
    })
  },
  [names.actions.setCompanyIdToUser] ({ rootState, commit }, companyId) {
    const userId = rootState.globalState[names.state.user][names.state.id]
    return new Promise((resolve, reject) => {
      axios.get(UrlMaker.getUrl(endpoints.joinToCompany) + '/' + companyId + '/' + userId)
        .then((response) => {
          commit(names.mutations.setCompanyIdToUser, companyId)
          resolve()
        }).catch((error) => {
          if (error.response.status !== 404) {
            reject(error)
            return
          }
          ErrorsAlert.errorAlert(error.response.data)
          resolve()
        })
    })
  }
}
