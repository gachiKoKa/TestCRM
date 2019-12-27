<template>
  <div>
    <b-navbar
      toggleable="lg"
      type="dark"
      variant="dark"
    >
      <b-navbar-brand>
        Test CRM
      </b-navbar-brand>

      <b-navbar-toggle target="nav-collapse" />

      <b-collapse
        id="nav-collapse"
        is-nav
      >
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <!-- Using 'button-content' slot -->
          <b-button
            class="mr-3"
            @click="toCompaniesTable"
          >
            Companies
          </b-button>
          <b-button
            v-if="isAdmin()"
            class="mr-3"
            @click="toEmployeesTable"
          >
            Users
          </b-button>
          <b-button @click="logout()">
            Logout
          </b-button>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script src="./NavBar.js"></script>
