<template>
  <div class="cook">
    <div class="cards" v-for="meal in meals" :key="meal.id">
      <Card :meal="meal" />
    </div>
    <v-btn color="orange lighten-2" class="mt-12" @click="overlay = !overlay">
      Générer le plan alimentaire
    </v-btn>
    <v-overlay :absolute="absolute" :opacity="opacity" :value="overlay">
      <v-text-field
        v-model="numberValue"
        label="Nombre de repas quotidien"
        type="number"
        min="2"
        max="5"
      ></v-text-field>
      <v-btn color="orange lighten-2" @click="overlay = false"> Annuler </v-btn>
      <v-btn color="green lighten-2" @click="generate">
        Confirmer
      </v-btn>
    </v-overlay>
  </div>
</template>

<script>
import Card from "@/components/Card";
import { mapActions } from 'vuex';
import store from '@/store';
export default {
  components: { Card },
  data() {
    return {
      absolute: true,
      opacity: 0.8,
      overlay: false,
      meals: [],
      numberValue: 4,
    };
  },
  methods: {
    ...mapActions(["generateFoodPlan"]),
    generate() {
      this.generateFoodPlan({userId:store.getters.StateUser.id,nbMeal:this.numberValue});
    },
  },
};
</script>
