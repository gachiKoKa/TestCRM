<template>
  <div>
    <div>
      <NavBar />
    </div>
    <div v-if="employees.length === 0">
      Don't have companies yet
    </div>
    <table
      v-else
      class="table table-striped table-dark"
    >
      <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Company</th>
        <th>Actions</th>
      </thead>
      <tbody>
        <tr
          v-for="employee in employees"
          :key="employee.id"
        >
          <td>{{ employee.name }}</td>
          <td>{{ employee.email }}</td>
          <td>{{ employee.role.name }}</td>
          <td v-if="employee.company === null">
            Unsigned to any company
          </td>
          <td v-else>
            {{ employee.company.name }}
          </td>
          <td v-if="isAdmin">
            <font-awesome-icon
              icon="trash"
              class="mr-sm-3"
              @click="deleteEmployee(employee.id)"
            />
            <font-awesome-icon
              v-b-modal.editEmployee
              icon="pencil-alt"
              @click="setEmployeeInfo(employee)"
            />
          </td>
        </tr>
      </tbody>
    </table>
    <Pagination />
    <div v-if="isAdmin">
      <b-button
        v-b-modal.addEmployee
        @click="resetEmployee()"
      >
        Add User
      </b-button>
      <AddEmployee />
    </div>
    <EditEmployee />
  </div>
</template>

<script src="./EmployeesTablePage.js"></script>
