import names from '../../constants/names'
import axios from 'axios'
import UrlMaker from '../../services/UrlMaker'
import endpoints from '../../constants/endpoints'
import ErrorsAlert from '../../services/ErrorsAlert'

export default {
  [names.actions.addEmployee] ({ state, dispatch }) {
    return new Promise((resolve, reject) => {
      axios.post(UrlMaker.getUrl(endpoints.employees), {
        name: state[names.state.employee][names.state.name],
        email: state[names.state.employee][names.state.email],
        password: state[names.state.employee][names.state.password],
        password_confirmation: state[names.state.employee][names.state.passwordConfirm],
        company_id: state[names.state.employee][names.state.companyId],
        role_id: state[names.state.employee][names.state.roleId]
      }).then(() => {
        dispatch(names.actions.getAllUsers)
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
  [names.actions.editEmployee] ({ getters, dispatch, state }) {
    const id = state[names.state.employee][names.state.id]
    const employeeData = getters[names.getters.getEmployeeData]
    return new Promise((resolve, reject) => {
      axios.patch(UrlMaker.getUrl(endpoints.employees) + '/' + id, employeeData).then(() => {
        dispatch(names.actions.getAllUsers)
        resolve()
      }).catch((error) => {
        if (error.response.status !== 422 && error.response.status !== 400) {
          reject(error.response)
          return
        }
        ErrorsAlert.errorAlert(error.response.data)
        resolve()
      })
    })
  }
}
