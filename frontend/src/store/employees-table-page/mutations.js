import names from '../../constants/names'

export default {
  [names.mutations.setAllUsers] (state, users) {
    state[names.state.employees] = users
  }
}
