import names from '../../constants/names'

export default {
  [names.mutations.signInUserEmail] (state, email) {
    state[names.state.email] = email
  },
  [names.mutations.signInUserPassword] (state, password) {
    state[names.state.password] = password
  }
}
