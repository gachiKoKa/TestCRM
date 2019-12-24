import Vue from 'vue'
import Vuex from 'vuex'
import GlobalState from './globalState'
import RegistrationPage from './registrationPage'

Vue.use(Vuex)

const modules = {
  globalState: GlobalState,
  registrationPage: RegistrationPage
}

export default new Vuex.Store({ modules: modules })
