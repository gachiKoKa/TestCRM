export default {
  actions: {
    registerUser: 'REGISTER_USER'
  },
  getters: {
  },
  mutations: {
    registerUserEmail: 'REGISTER_USER_EMAIL',
    registerUserName: 'REGISTER_USER_NAME',
    registerUserPassword: 'REGISTER_USER_PASSWORD',
    registerUserPasswordConfirmation: 'REGISTER_USER_PASSWORD_CONFIRMATION',
    setUserToGlobalState: 'SET_USER_TO_GLOBAL_STATE'
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
    id: 'ID'
  }
}
