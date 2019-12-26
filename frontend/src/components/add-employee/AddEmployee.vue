<template>
  <b-modal
    id="addEmployee"
    title="Add Employee"
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
          @click="addEmployee()"
        >
          OK
        </b-button>
      </span>
    </template>
  </b-modal>
</template>

<script src="./AddEmployee.js"></script>
