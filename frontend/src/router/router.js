import Vue from 'vue'
import Router from 'vue-router'
import RegisterPage from '../components/register-page/RegisterPage.vue'
import SignInPage from '../components/sign-in-page/SignInPage.vue'
import DataTablePage from '../components/data-table-page/DataTablePage.vue'
import EmployeesTablePage from '../components/employees-table-page/EmployeesTablePage.vue'
import PageNotFoundComponent from '../components/errors/PageNotFound.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '*',
      component: PageNotFoundComponent
    },
    {
      path: '/register-page',
      name: 'register-page',
      component: RegisterPage
    },
    {
      path: '/',
      name: 'sign-in-page',
      component: SignInPage
    },
    {
      path: '/data-table-page',
      name: 'data-table-page',
      component: DataTablePage
    },
    {
      path: '/employees-table-page',
      name: 'employees-table-page',
      component: EmployeesTablePage
    }
  ]
})
