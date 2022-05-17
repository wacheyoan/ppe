<template>
  <div class="cook">
    <div class="cards" v-for="foodPlan in getFoodPlans" :key="foodPlan.id">
      <Card :foodPlan="foodPlan" />
    </div>

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
    <v-row
        justify="center"
>
      <v-btn color="orange lighten-2" class="mt-12"  @click="overlay = !overlay">
        Générer le plan alimentaire
      </v-btn>
    </v-row>

  </div>
</template>

<script>
import Card from "@/components/Card";
import {mapActions, mapState} from 'vuex';
import store from '@/store';
export default {
  components: { Card },
  data() {
    return {
      absolute: false,
      opacity: 0.8,
      overlay: false,
      meals: [],
      numberValue: 4
    };
  },
  async mounted() {
    await this.$store.dispatch("actionUpdateFoodPlansOfUser");
  },
  computed: {
    getFoodPlans() {
      return this.$store.getters['getFoodPlansOfUser'];
    }
  },
  methods: {
    ...mapActions(["generateFoodPlan"]),
    async generate() {
      await this.generateFoodPlan({userId:store.getters.StateUser.id,nbMeal:this.numberValue});
      await this.$store.dispatch("actionUpdateFoodPlansOfUser");
    },
  },
};
</script>

<style scoped>
.cards{
  margin: 16px 0;
}

</style>
