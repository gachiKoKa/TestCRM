import Vue from 'vue'
import Vuex from 'vuex'
import GlobalState from './globalState'
import RegistrationPage from './registrationPage'
import SignInPage from './signInPage'

Vue.use(Vuex)

const modules = {
  globalState: GlobalState,
  registrationPage: RegistrationPage,
  signInPage: SignInPage
}

export default new Vuex.Store({ modules: modules })
