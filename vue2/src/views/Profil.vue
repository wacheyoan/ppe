<template>
  <div class="main-container">
    <span v-if="isLoggedIn">
      <a @click="logout" >Déconnexion</a>
    </span>
    <v-card v-if="user"
        elevation="2"
        outlined
        tile
    >
      <v-card-text class="content">
        <v-card-title>Informations</v-card-title>
        <span>{{ user.firstName}} {{user.lastName}}</span>
        <span>{{ user.email }}</span>
        <span>{{ user.birthDate | ageFromBirthDate }} ans</span>
        <span>Objectif : {{ user.objective.wording}}</span>
        <span>Niveau d'activité : {{ user.activity.wording }}</span>
        <v-card-actions>
          <v-btn
              color="orange"
              text
          >
            Editer
          </v-btn>
        </v-card-actions>
      </v-card-text>
    </v-card>

    <v-card v-if="user"
            elevation="2"
            outlined
            tile
    >
      <v-card-text class="content">
        <v-card-title>Objectifs</v-card-title>
        <span>Métabolisme basal : {{getBMR()}} Kcal</span>
        <span>Entretien : {{getEntretien()}} Kcal</span>
        <span>Objectif calorique : {{getCalories()}} Kcal</span>
      </v-card-text>
    </v-card>

  </div>
</template>


<script>

import UserService from "@/service/user.service";
export default {
  name: 'Profil',
  data() {
    return {
      user: null,
    }
  },
  computed : {
    isLoggedIn : function(){ return this.$store.getters.isAuthenticated}
  },
  mounted() {
    this.user = this.$store.getters.StateUser;
  },
  methods: {
    async logout (){
      await this.$store.dispatch('LogOut').then(()=>{
        this.$router.push('/login')
      })
    },
    getBMR(){
      return UserService.getBMR(this.user);
    },
    getEntretien() {
      return UserService.getEntretien(this.user);
    },
    getCalories() {
      return UserService.getObjectiveCalorie(this.user);
    }
  },
}
</script>

<style scoped>
.content{
  display: flex;
  flex-direction: column;
  gap: 4px;
  >span{
    padding: 0 16px;
  }
}
.main-container{
  display: flex;
  flex-direction: column;
  gap: 24px;
}
</style>
