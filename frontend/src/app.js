import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import store from './store'
import router from './router/router'
import AppComponent from './components/App.vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faPencilAlt, faSearchPlus, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import names from './constants/names'
import VueCookie from 'vue-cookie'
import axios from 'axios'

Vue.use(BootstrapVue)
library.add(faPencilAlt, faSearchPlus, faTrash)
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.config.productionTip = false
router.beforeEach((to, from, next) => {
  const token = VueCookie.get('token')
  const id = store.state.globalState[names.state.user][names.state.id]
  const loggedOut = id === 0 && to.name !== 'sign-in-page' && to.name !== 'register-page'

  if (token !== null) {
    store.commit(names.mutations.setAuthConfig, token)
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
    store.dispatch(names.actions.getUser).then(() => {
      next()
    }, () => {
      next({ name: 'sign-in-page' })
    })
    return
  }

  if (loggedOut) {
    next({ name: 'sign-in-page' })
    return
  }

  next()
})

/* eslint-disable-next-line no-new */
new Vue({
  el: '#app',
  router,
  store,
  render: h => h(AppComponent)
})
