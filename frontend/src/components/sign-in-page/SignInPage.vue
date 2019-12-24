<template>
  <div class>
    <b-row class="justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            Sign In
          </div>
          <div class="card-body">
            <b-form
              id="signInForm"
              title="Sign In"
            >
              <b-input-group
                prepend="Email"
                class="mt-3"
              >
                <b-form-input
                  v-model="email"
                  type="email"
                />
              </b-input-group>
              <b-input-group
                prepend="Password"
                class="mt-3"
              >
                <b-form-input
                  v-model="password"
                  type="password"
                />
              </b-input-group>
              <div class="row mb-0 form-group">
                <div class="col-md-6 offset-md-4 mt-3">
                  <b-button
                    type="submit"
                    variant="outline-dark"
                    @click.prevent="signIn()"
                  >
                    Sign In
                  </b-button>
                </div>
              </div>
            </b-form>
          </div>
        </div>
      </div>
    </b-row>
  </div>
</template>

<script src="./SignInPage.js"></script>
