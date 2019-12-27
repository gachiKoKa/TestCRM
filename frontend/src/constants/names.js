export default {
  actions: {
    registerUser: 'REGISTER_USER',
    signInUser: 'SIGN_IN_USER',
    addCompany: 'ADD_COMPANY',
    getCompanies: 'GET_COMPANIES',
    editCompany: 'EDIT_COMPANY',
    deleteCompany: 'DELETE_COMPANY',
    addEmployee: 'ADD_EMPLOYEE',
    getAllCompanies: 'GET_ALL_COMPANIES',
    getAllUsers: 'GET_ALL_USERS',
    editEmployee: 'EDIT_EMPLOYEE',
    deleteEmployee: 'DELETE_EMPLOYEE',
    setCompanyIdToUser: 'SET_COMPANY_ID_TO_USER'
  },
  getters: {
    getEmployeeData: 'GET_EMPLOYEE_DATA',
    getDefaultCompanyId: 'GET_DEFAULT_COMPANY_ID',
    getDefaultRoleId: 'GET_DEFAULT_ROLE_ID'
  },
  mutations: {
    registerUserEmail: 'REGISTER_USER_EMAIL',
    registerUserName: 'REGISTER_USER_NAME',
    registerUserPassword: 'REGISTER_USER_PASSWORD',
    registerUserPasswordConfirmation: 'REGISTER_USER_PASSWORD_CONFIRMATION',
    setUserToGlobalState: 'SET_USER_TO_GLOBAL_STATE',
    signInUserEmail: 'SIGN_IN_USER_EMAIL',
    signInUserPassword: 'SIGN_IN_USER_PASSWORD',
    setRoleToUser: 'SET_ROLE_TO_USER',
    setCompanyId: 'SET_COMPANY_ID',
    setCompanyEmail: 'SET_COMPANY_EMAIL',
    setCompanyName: 'SET_COMPANY_NAME',
    setCompanyWebSite: 'SET_COMPANY_WEB_SITE',
    setCompanyLogo: 'SET_COMPANY_LOGO',
    setCompanyInputsToDefault: 'SET_COMPANY_INPUTS_TO_DEFAULT',
    setCompanies: 'SET_COMPANIES',
    setCompanyValuesForEdit: 'SET_COMPANY_VALUES_FOR_EDIT',
    setEmployeeName: 'SET_EMPLOYEE_NAME',
    setEmployeeEmail: 'SET_EMPLOYEE_EMAIL',
    setEmployees: 'SET_EMPLOYEES',
    setEmployeePassword: 'SET_EMPLOYEE_PASSWORD',
    setEmployeePasswordConfirmation: 'SET_EMPLOYEE_PASSWORD_CONFIRMATION',
    setEmployeeCompanyId: 'SET_EMPLOYEE_COMPANY_ID',
    setAllCompanies: 'SET_ALL_COMPANIES',
    setEmployeeInputsToDefault: 'SET_EMPLOYEE_INPUTS_TO_DEFAULT',
    setAllRoles: 'SET_ALL_ROLES',
    setEmployeeRoleId: 'SET_EMPLOYEE_ROLE_ID',
    setAllUsers: 'SET_ALL_USERS',
    setUserValueForEdit: 'SET_USER_VALUE_FOR_EDIT',
    setCompanyIdToUser: 'SET_COMPANY_ID_TO_USER'
  },
  state: {
    email: 'EMAIL',
    name: 'NAME',
    password: 'PASSWORD',
    passwordConfirm: 'PASSWORD_CONFIRM',
    user: 'USER',
    roleId: 'ROLE_ID',
    admin: 'ADMIN',
    employee: 'EMPLOYEE',
    id: 'ID',
    companies: 'COMPANIES',
    webSite: 'WEB_SITE',
    logo: 'LOGO',
    logoFile: 'LOGO_FILE',
    logoUrl: 'LOGO_URL',
    company: 'COMPANY',
    companyId: 'COMPANY_ID',
    employees: 'EMPLOYEES',
    allCompanies: 'ALL_COMPANIES',
    allRoles: 'ALL_ROLES'
  }
}
