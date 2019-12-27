import names from '../../constants/names'
import axios from 'axios'
import UrlMaker from '../../services/UrlMaker'
import endpoints from '../../constants/endpoints'
import PropChecker from '../../services/PropChecker'
import ErrorsAlert from '../../services/ErrorsAlert'

export default {
  [names.actions.getAllUsers] ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get(UrlMaker.getUrl(endpoints.employees)).then((response) => {
        if (PropChecker.hasData(response)) {
          commit(names.mutations.setAllUsers, response.data)
        }
        resolve()
      }).catch((error) => {
        reject(error.response.data)
      })
    })
  },
  [names.actions.deleteEmployee] ({ dispatch }, userId) {
    return new Promise((resolve, reject) => {
      axios.delete(UrlMaker.getUrl(endpoints.employees) + '/' + userId).then((response) => {
        dispatch(names.actions.getAllUsers)
        resolve()
      }).catch((error) => {
        if (error.response.status !== 400) {
          reject(error.response.data)
          return
        }
        ErrorsAlert.errorAlert(error.response.data)
        resolve()
      })
    })
  }
}
