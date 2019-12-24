import names from '../../constants/names'

export default {
  computed: {
    email: {
      get () {
        return this.$store.state.registrationPage[names.state.email]
      },
      set (value) {
        this.$store.commit(names.mutations.registerUserEmail, value)
      }
    },
    name: {
      get () {
        return this.$store.state.registrationPage[names.state.name]
      },
      set (value) {
        this.$store.commit(names.mutations.registerUserName, value)
      }
    },
    password: {
      get () {
        return this.$store.state.registrationPage[names.state.password]
      },
      set (value) {
        this.$store.commit(names.mutations.registerUserPassword, value)
      }
    },
    password_confirm: {
      get () {
        return this.$store.state.registrationPage[names.state.passwordConfirm]
      },
      set (value) {
        this.$store.commit(names.mutations.registerUserPasswordConfirmation, value)
      }
    }
  },
  methods: {
    registerUser () {
      this.$store.dispatch(names.actions.registerUser)
    }
  }
}
