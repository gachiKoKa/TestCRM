import AddAndEditCompanyInputs from '../add-and-edit-company-inputs/AddAndEditCompanyInputs.vue'
import names from '../../constants/names'

export default {
  components: {
    AddAndEditCompanyInputs: AddAndEditCompanyInputs
  },
  methods: {
    editUser () {
      this.$store.dispatch(names.actions.editCompany)
    }
  }
}
