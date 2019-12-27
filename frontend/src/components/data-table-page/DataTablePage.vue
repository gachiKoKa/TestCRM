<template>
  <div>
    <div>
      <NavBar />
    </div>
    <div v-if="companies.length === 0">
      Чичяс компаний нет
    </div>
    <table
      v-else
      class="table table-striped table-dark"
    >
      <thead>
        <th>Logo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Web Site</th>
        <th>Status</th>
        <th>Actions</th>
      </thead>
      <tbody>
        <tr
          v-for="company in companies"
          :key="company.id"
        >
          <td>
            <b-img
              v-if="company.logo.length > 0"
              thumbnail
              fluid
              width="100"
              height="100"
              :src="company.logo"
              alt="default-img"
            />
          </td>
          <td>{{ company.name }}</td>
          <td>{{ company.email }}</td>
          <td>{{ company.web_site }}</td>
          <td v-if="joinedToCompany(company.id)">
            Joined
          </td>
          <td v-if="isAdmin">
            <font-awesome-icon
              icon="trash"
              class="mr-sm-3"
              @click="deleteCompany(company.id)"
            />
            <font-awesome-icon
              v-b-modal.editCompany
              icon="pencil-alt"
              @click="setCompanyInfo(company)"
            />
          </td>
          <td v-else>
            <b-button @click="subscribeToCompany(company.id)">
              Subscribe
            </b-button>
          </td>
        </tr>
      </tbody>
    </table>
    <div v-if="isAdmin">
      <b-button
        v-b-modal.addCompany
        @click="resetCompany()"
      >
        Add Company
      </b-button>
      <AddCompany />
    </div>
    <EditCompany />
  </div>
</template>
<script src="./DataTablePage.js"></script>
