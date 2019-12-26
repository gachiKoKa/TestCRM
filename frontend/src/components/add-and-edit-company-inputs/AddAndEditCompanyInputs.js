import names from '../../constants/names'
import constants from '../../constants/common-constants'

export default {
  computed: {
    name: {
      get () {
        return this.$store.state.addAndEditCompanyInputs[names.state.company][names.state.name]
      },
      set (value) {
        this.$store.commit(names.mutations.setCompanyName, value)
      }
    },
    email: {
      get () {
        return this.$store.state.addAndEditCompanyInputs[names.state.company][names.state.email]
      },
      set (value) {
        this.$store.commit(names.mutations.setCompanyEmail, value)
      }
    },
    webSite: {
      get () {
        return this.$store.state.addAndEditCompanyInputs[names.state.company][names.state.webSite]
      },
      set (value) {
        this.$store.commit(names.mutations.setCompanyWebSite, value)
      }
    },
    defaultImage () {
      return constants.defaultImage
    },
    logoSrc () {
      return this.$store.state.addAndEditCompanyInputs[names.state.company][names.state.logo][names.state.logoUrl]
    }

  },
  methods: {
    trigger () {
      this.$refs.companyLogo.click()
    },
    getFile (event) {
      const file = event.target.files[0] || event.dataTransfer.files[0]
      this.$store.commit(names.mutations.setCompanyLogo, file)
    }

  }
}
