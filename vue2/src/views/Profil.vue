<template>
  <div class="main-container">

    <v-card v-if="user"
        elevation="2"
        outlined
        tile
    >
      <v-card-text>
        <v-card-title>Informations</v-card-title>
        <div class="content">
        <span>{{ user.firstName}} {{user.lastName}}</span>
        <span>{{ user.email }}</span>
        <span>{{ user.birthDate | ageFromBirthDate }} ans</span>
        <span>Objectif : {{ user.objective.wording}}</span>
        <span>Niveau d'activité : {{ user.activity.wording }}</span>
        </div>
        <v-card-actions class="button-container">
          <v-btn
              color="orange"
              text
          >
            Editer
          </v-btn>
              <v-btn v-if="isLoggedIn" @click="logout">
             Déconnexion
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
        <div class="content">
        <span>Métabolisme basal : {{getBMR()}} Kcal</span>
        <span>Entretien : {{getEntretien()}} Kcal</span>
        <span>Objectif calorique : {{getCalories()}} Kcal</span>
        </div>
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
  padding: 14px;
  display: flex;
  flex-direction: column;
  gap: 4px;

}
.main-container{
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.button-container
{
  display: flex;
  justify-content: space-between;
}
</style>
