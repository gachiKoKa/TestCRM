<template>
  <div>
    <b-input-group
      prepend="Name"
      class="mt-3"
    >
      <b-form-input
        v-model="name"
        type="text"
      />
    </b-input-group>
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
    <b-input-group
      prepend="Confirm Password"
      class="mt-3"
    >
      <b-form-input
        v-model="password_confirmation"
        type="password"
      />
    </b-input-group>
    <b-input-group
      prepend="Company"
      class="mt-3"
    >
      <b-form-select v-model="company">
        <option
          v-for="company in companies"
          :key="company.id"
          :value="company.id"
        >
          {{ company.name }}
        </option>
        <option :value="null">
          Without company
        </option>
      </b-form-select>
      <b-input-group
        prepend="Role"
        class="mt-3"
      >
        <b-form-select v-model="role">
          <option
            v-for="role in roles"
            :key="role.id"
            :value="role.id"
          >
            {{ role.name }}
          </option>
        </b-form-select>
      </b-input-group>
    </b-input-group>
  </div>
</template>

<script src="./AddAndEditEmployeeInputs.js"></script>
