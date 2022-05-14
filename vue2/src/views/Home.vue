<template>
  <swipeable-cards></swipeable-cards>
</template>

<script lang="ts">
  import Vue from 'vue'
  import SwipeableCards from "@/components/SwipeableCards.vue";

  export default Vue.extend({
    name: 'Home',
    components: {SwipeableCards},
  })
</script>
