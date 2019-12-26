import Vue from 'vue'
import Router from 'vue-router'
import RegisterPage from '../components/register-page/RegisterPage.vue'
import SignInPage from '../components/sign-in-page/SignInPage.vue'
import DataTablePage from '../components/data-table-page/DataTablePage.vue'
import EmployeesTablePage from '../components/employees-table-page/EmployeesTablePage.vue'

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
