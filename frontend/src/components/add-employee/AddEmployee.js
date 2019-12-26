import AddAndEditEmployeeInputs from '../add-and-edit-employee-inputs/AddAndEditEmployeeInputs.vue'
import names from '../../constants/names'

export default {
  components: {
    AddAndEditEmployeeInputs: AddAndEditEmployeeInputs
  },
  methods: {
    addEmployee () {
      this.$store.dispatch(names.actions.addEmployee)
    }
  }
}
