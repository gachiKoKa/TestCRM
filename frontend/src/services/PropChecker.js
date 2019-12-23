export default {
  has (object, prop) {
    return !!Object.prototype.hasOwnProperty.call(object, prop)
  },
  hasData (object) {
    return this.has(object, 'data')
  }
}
