import constants from '../../src/constants/common-constants'

export default {
  getUrl (endpoint) {
    return constants.apiUrl + endpoint
  }
}
