import names from '../../constants/names'
import NavBar from '../nav-bar/NavBar.vue'
import AddEmployee from '../add-employee/AddEmployee.vue'
import EditEmployee from '../edit-employee/EditEmployee.vue'
import Pagination from '../pagination/Pagination.vue'

export default {
  components: {
    NavBar: NavBar,
    AddEmployee: AddEmployee,
    EditEmployee: EditEmployee,
    Pagination: Pagination
  },
  beforeCreate () {
    this.$store.dispatch(names.actions.getAllUsers)
  },
  computed: {
    isAdmin () {
      return !!this.$store.state.globalState[names.state.user][names.state.admin]
    },
    employees () {
      return this.$store.state.employeesTablePage[names.state.employees]
    }
  },
  methods: {
    resetEmployee () {
      this.$store.commit(
        names.mutations.setEmployeeInputsToDefault,
        this.$store.getters[names.getters.getDefaultRoleId]
      )
    },
    setEmployeeInfo (userInfo) {
      this.$store.commit(names.mutations.setUserValueForEdit, userInfo)
    },
    deleteEmployee (userId) {
      this.$store.dispatch(names.actions.deleteEmployee, userId)
    }
  }
}
