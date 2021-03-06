import Vue from 'vue'
import Vuex from 'vuex'
import GlobalState from './globalState'
import RegistrationPage from './registrationPage'
import SignInPage from './signInPage'
import DataTablePage from './dataTablePage'
import AddAndEditCompanyInputs from './addAndEditCompanyInputs'
import EmployeesTablePage from './employeesTablePage'
import AddAndEditEmployeeInputs from './addAndEditEmployeeInputs'
import Pagination from './pagination'

Vue.use(Vuex)

const modules = {
  globalState: GlobalState,
  registrationPage: RegistrationPage,
  signInPage: SignInPage,
  dataTablePage: DataTablePage,
  addAndEditCompanyInputs: AddAndEditCompanyInputs,
  employeesTablePage: EmployeesTablePage,
  addAndEditEmployeeInputs: AddAndEditEmployeeInputs,
  pagination: Pagination
}

export default new Vuex.Store({ modules: modules })
