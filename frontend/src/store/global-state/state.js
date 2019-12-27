import names from '../../constants/names'

export default {
  [names.state.allRoles]: [],
  [names.state.user]: {
    [names.state.id]: 0,
    [names.state.email]: '',
    [names.state.name]: '',
    [names.state.roleId]: 0,
    [names.state.companyId]: null,
    [names.state.admin]: false,
    [names.state.employee]: false
  }
}
