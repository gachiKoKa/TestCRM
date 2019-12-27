<template>
  <ul class="pagination justify-content-center">
    <li
      v-for="item in pagination"
      :key="item.id"
      class="page-item"
      :disabled="currentPage === item.disabled"
      :class="[{ disabled: currentPage === item.disabled }, {active: currentPage === item.toPage}]"
      @click.prevent="redirect(item)"
    >
      <div
        class="page-link"
      >
        {{ item.text }}
      </div>
    </li>
  </ul>
</template>

<script src="./Pagination.js"></script>
