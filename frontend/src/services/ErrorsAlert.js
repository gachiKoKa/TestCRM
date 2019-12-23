import PropChecker from './PropChecker'

export default {
  errorAlert (errorsObj) {
    if (typeof errorsObj === 'string' && errorsObj.length > 0) {
      alert(errorsObj)
      return
    }

    let message = ''

    if (Array.isArray(errorsObj)) {
      for (const item of errorsObj) {
        message += item + '\n'
      }

      if (message !== '') {
        alert(message)
        return
      }
    }

    if (typeof errorsObj === 'object') {
      const keys = Object.keys(errorsObj)
      for (const key of keys) {
        if (PropChecker.has(errorsObj, key)) {
          for (const item of errorsObj[key]) {
            message += item + '\n'
          }
        }
      }

      if (message !== '') {
        alert(message)
      }
    }
  }
}
