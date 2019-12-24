import Vue from 'vue'
import Router from 'vue-router'
import RegisterPage from '../components/register-page/RegisterPage.vue'
import SignInPage from '../components/sign-in-page/SignInPage.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'register-page',
      component: RegisterPage
    },
    {
      path: '/sign-in',
      name: 'sign-in-page',
      component: SignInPage
    }

  ]
})
