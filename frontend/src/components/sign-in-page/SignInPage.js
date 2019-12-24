import names from '../../constants/names'

export default {
  computed: {
    email: {
      get () {
        return this.$store.state.signInPage[names.state.email]
      },
      set (value) {
        this.$store.commit(names.mutations.signInUserEmail, value)
      }
    },
    password: {
      get () {
        return this.$store.state.signInPage[names.state.password]
      },
      set (value) {
        this.$store.commit(names.mutations.signInUserPassword, value)
      }
    }
  },
  methods: {
    signIn () {
      this.$store.dispatch(names.actions.signInUser)
    }
  }
}
