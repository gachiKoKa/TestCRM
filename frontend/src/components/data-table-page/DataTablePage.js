import NavBar from '../nav-bar/NavBar.vue'
import names from '../../constants/names'
import AddCompany from '../add-company/AddCompany.vue'
import EditCompany from '../edit-company/EditCompany.vue'
import Pagination from '../pagination/Pagination.vue'

export default {
  components: {
    NavBar: NavBar,
    AddCompany: AddCompany,
    EditCompany: EditCompany,
    Pagination: Pagination
  },
  beforeCreate () {
    this.$store.dispatch(names.actions.getCompanies)
  },
  computed: {
    companies () {
      return this.$store.state.dataTablePage[names.state.companies]
    },
    isAdmin () {
      return !!this.$store.state.globalState[names.state.user][names.state.admin]
    }
  },
  methods: {
    resetCompany () {
      this.$store.commit(names.mutations.setCompanyInputsToDefault)
    },
    setCompanyInfo (companyData) {
      this.$store.commit(names.mutations.setCompanyValuesForEdit, companyData)
    },
    deleteCompany (companyId) {
      this.$store.dispatch(names.actions.deleteCompany, companyId)
    },
    subscribeToCompany (companyId) {
      this.$store.dispatch(names.actions.setCompanyIdToUser, companyId)
    },
    joinedToCompany (companyId) {
      return this.$store.state.globalState[names.state.user][names.state.companyId] === companyId
    }
  }
}
