import names from '../../constants/names'
import axios from 'axios'
import UrlMaker from '../../services/UrlMaker'
import endpoints from '../../constants/endpoints'
import PropChecker from '../../services/PropChecker'
import ErrorsAlert from '../../services/ErrorsAlert'
import router from '../../router/router'

export default {
  [names.actions.signInUser] ({ commit, state }) {
    return new Promise((resolve, reject) => {
      axios.post(UrlMaker.getUrl(endpoints.signInUser), {
        email: state[names.state.email],
        password: state[names.state.password]
      }).then((response) => {
        if (PropChecker.hasData(response)) {
          commit(names.mutations.setUserToGlobalState, response.data.user)
          commit(names.mutations.setRoleToUser, response.data)
          commit(names.mutations.setAllRoles, response.data.roles)
          router.push({ name: 'data-table-page' })
        }
        resolve()
      }).catch((error) => {
        if (error.response.status !== 422 || error.response.status !== 400) {
          reject(error.response)
          return
        }
        ErrorsAlert.errorAlert(error.response.data)
        resolve()
      })
    })
  }
}
