import names from '../../constants/names'

export default {
  [names.mutations.registerUserEmail] (state, value) {
    state[names.state.email] = value
  },
  [names.mutations.registerUserName] (state, value) {
    state[names.state.name] = value
  },
  [names.mutations.registerUserPassword] (state, value) {
    state[names.state.password] = value
  },
  [names.mutations.registerUserPasswordConfirmation] (state, value) {
    state[names.state.passwordConfirm] = value
  }
}
