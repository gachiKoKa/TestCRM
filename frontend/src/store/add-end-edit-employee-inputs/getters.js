import names from '../../constants/names'

export default {
  [names.getters.getEmployeeData] (state) {
    const employeeState = state[names.state.employee]
    const data = {}

    if (employeeState[names.state.name] !== '') {
      data.name = employeeState[names.state.name]
    }
    if (employeeState[names.state.email] !== '') {
      data.email = employeeState[names.state.email]
    }
    if (employeeState[names.state.password] !== '') {
      data.password = employeeState[names.state.password]
      data.password_confirmation = employeeState[names.state.passwordConfirm]
    }
    if (employeeState[names.state.companyId] !== 0) {
      data.company_id = employeeState[names.state.companyId]
    }
    if (employeeState[names.state.roleId] !== 0) {
      data.role_id = employeeState[names.state.roleId]
    }

    return data
  }
}
