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
  [names.actions.setCompanyIdToUser] (companyId, userId) {
    console.log(companyId)
    return new Promise((resolve, reject) => {
      axios.get(UrlMaker.getUrl(endpoints.companies) + '/' + companyId + '/' + userId)
        .then((response) => {
          resolve()
        }).catch((error) => {
          ErrorsAlert.errorAlert(error.response.data)
          resolve()
        })
    })
  }
}
