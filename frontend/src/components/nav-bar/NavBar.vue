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
            v-if="isAdmin"
            class="mr-3"
            @click="toEmployeesTable"
          >
            Employees
          </b-button>
          <b-button>Logout</b-button>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script src="./NavBar.js"></script>
