<template>
  <v-app>
    <v-container fill-height>
    <v-bottom-navigation
        v-model="value"
        dark
        grow
        shift
        v-if="isLoggedIn"
    >
      <v-btn to="/cook" color="orange accent-3">
        <span>Cuisine</span>
        <v-icon>mdi-chef-hat</v-icon>
      </v-btn>

      <v-btn to="/" color="red accent-3">
        <span>Swiper</span>
        <v-icon>mdi-heart</v-icon>
      </v-btn>

      <v-btn to="/profil" color="blue accent-3">
        <span>Profil</span>
        <v-icon large>mdi-account</v-icon>
      </v-btn>

    </v-bottom-navigation>
    <router-view></router-view>
    </v-container>
  </v-app>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  name: 'App',
  computed : {
    isLoggedIn : function(){ return this.$store.getters.isAuthenticated}
  },
  data: () => ({
    value: 0
  }),
  methods: {
    async logout (){
      await this.$store.dispatch('LogOut')
      await this.$router.push('/login')
    }
  },

});
</script>

<style lang="scss">
.v-bottom-navigation{
  position: absolute !important;
  &>a,&>button{
    height: 100% !important;
  }
}
</style>
