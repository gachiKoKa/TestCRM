import axios from 'axios/index'
import UrlMaker from '../../services/UrlMaker'
import names from '../../constants/names'
import PropChecker from '../../services/PropChecker'
import endpoints from '../../constants/endpoints'

export default {
  [names.actions.getUser] ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get(UrlMaker.getUrl(endpoints.getUser)).then((response) => {
        if (PropChecker.hasData(response)) {
          commit(names.mutations.setUserToGlobalState, response.data.user)
          commit(names.mutations.setRoleToUser, response.data)
          commit(names.mutations.setAllRoles, response.data.roles)
          commit(names.mutations.setAuthConfig, response.data.token)
        }
        resolve()
      }).catch((error) => {
        reject(error.response)
      })
    })
  }
}
