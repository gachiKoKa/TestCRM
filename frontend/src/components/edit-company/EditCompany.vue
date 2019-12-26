<template>
  <b-modal
    id="editCompany"
    title="Edit Company"
    hide-backdrop
  >
    <AddAndEditCompanyInputs />
    <template v-slot:modal-footer="{ cancel, ok }">
      <b-button
        variant="dark"
        @click="cancel()"
      >
        Cancel
      </b-button>
      <span @click="ok()">
        <b-button
          variant="outline-dark"
          @click="editUser()"
        >
          OK
        </b-button>
      </span>
    </template>
  </b-modal>
</template>

<script src="./EditCompany.js"></script>
