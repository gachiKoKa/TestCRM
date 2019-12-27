import names from '../../constants/names'
import axios from 'axios'
import UrlMaker from '../../services/UrlMaker'
import endpoints from '../../constants/endpoints'
import PropChecker from '../../services/PropChecker'
import ErrorsAlert from '../../services/ErrorsAlert'
import router from '../../router/router'

export default {
  [names.actions.registerUser] ({ commit, state }) {
    return new Promise((resolve, reject) => {
      axios.post(UrlMaker.getUrl(endpoints.registerUser), {
        email: state[names.state.email],
        name: state[names.state.name],
        password: state[names.state.password],
        password_confirmation: state[names.state.passwordConfirm]
      }).then((response) => {
        if (PropChecker.hasData(response)) {
          commit(names.mutations.setUserToGlobalState, response.data.user)
          commit(names.mutations.setRoleToUser, response.data)
          commit(names.mutations.setAllRoles, response.data.roles)
          commit(names.mutations.setAuthConfig, response.data.token)
          router.push({ name: 'data-table-page' })
        }
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
  }
}
