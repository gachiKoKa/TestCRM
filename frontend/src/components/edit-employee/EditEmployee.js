import AddAndEditEmployeeInputs from '../add-and-edit-employee-inputs/AddAndEditEmployeeInputs.vue'
import names from '../../constants/names'

export default {
  components: {
    AddAndEditEmployeeInputs: AddAndEditEmployeeInputs
  },
  methods: {
    editEmployee () {
      this.$store.dispatch(names.actions.editEmployee)
    }
  }
}
