<template>
  <v-app>
    <v-container>
    <v-bottom-navigation
        v-model="value"
        dark
        grow
        shift
        v-if="isLoggedIn"
    >
      <v-btn to="/foodplan"    active-class=""
      >
        <span>Plan</span>
        <v-icon>mdi-clipboard-text-multiple-outline </v-icon>
      </v-btn>

      <v-btn
          to="/aliments"
          active-class=""
      >
        <span>Aliments</span>
        <v-icon>mdi-food-fork-drink </v-icon>
      </v-btn>

      <v-btn to="/"     active-class=""
      >
        <span>Swiper</span>
        <v-icon>mdi-heart</v-icon>
      </v-btn>


      <v-btn
          to="/cooking"
          active-class=""
          disabled
      >
        <span>Cuisine</span>
        <v-icon>mdi-chef-hat </v-icon>
      </v-btn>

      <v-btn to="/profil"    active-class=""
      >
        <span>Profil</span>
        <v-icon large>mdi-account</v-icon>
      </v-btn>
    </v-bottom-navigation>
      <v-slide-y-transition>

      <router-view></router-view>
      </v-slide-y-transition>

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
.container{
  padding: 32px !important;
  min-height: 100vh;
  position: relative;
}
.v-bottom-navigation{
  position: fixed !important;
  z-index: 999;
  &>a,&>button{
    height: 100% !important;
  }
}
 form{
   width: 100%;

 }
 .container{
   >*:not(:first-child){
     margin-bottom: 72px;
   }
 }

.cards{
  margin: 16px 0;
}
  .center{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%
  }
div[role="progressbar"]
{  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
}

.absolute{
  position: absolute !important;
  left: 0;
  top: 0;
  transform: translate(50%, 50%);
}



</style>

