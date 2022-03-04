<template>
  <v-app>
<!--    <swipeable-cards />-->
    <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/login">Login</router-link>
    </div>
    <router-view />
  </v-app>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  name: 'App',
  async mounted() {
    await this.$store.dispatch("actionUpdateGetterAllMeals");
  }
});
</script>
