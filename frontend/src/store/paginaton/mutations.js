import names from '../../constants/names'

export default {
  [names.mutations.setPagination] (state, pagination) {
    state[names.state.pagination] = pagination
  },
  [names.mutations.setCurrentPage] (state, currentPage) {
    state[names.state.currentPage] = currentPage
  },
  [names.mutations.setAction] (state, action) {
    state[names.state.action] = action
  }
}
