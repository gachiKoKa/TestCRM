import names from '../../constants/names'
import axios from 'axios'
import UrlMaker from '../../services/UrlMaker'
import endpoints from '../../constants/endpoints'
import PropChecker from '../../services/PropChecker'
import ErrorsAlert from '../../services/ErrorsAlert'

export default {
  [names.actions.registerUser] ({ commit, state }) {
    console.log(state)
    return new Promise((resolve, reject) => {
      axios.post(UrlMaker.getUrl(endpoints.registerUser), {
        email: state[names.state.email],
        name: state[names.state.name],
        password: state[names.state.password],
        password_confirmation: state[names.state.passwordConfirm]
      }).then((response) => {
        if (PropChecker.hasData(response)) {
          commit(names.mutations.setUserToGlobalState, response.data)
        }
        resolve()
      }).catch((error) => {
        if (error.response.status !== 422) {
          ErrorsAlert.errorAlert(error.response.data)
          reject(error.response)
          return
        }

        resolve()
      })
    })
  }
}
