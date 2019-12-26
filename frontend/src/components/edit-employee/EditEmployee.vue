<template>
  <b-modal
    id="editEmployee"
    title="Edit Employee"
    hide-backdrop
  >
    <AddAndEditEmployeeInputs />
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
          @click="editEmployee()"
        >
          OK
        </b-button>
      </span>
    </template>
  </b-modal>
</template>

<script src="./EditEmployee.js"></script>
