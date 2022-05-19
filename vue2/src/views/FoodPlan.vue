<template>
  <div class="cook"  v-if="foodPlan">
    <v-btn
        to="/cook"
    >
      <v-icon
          color="white"
      >
        mdi-arrow-left-top
      </v-icon>
    </v-btn>
    <div class="cards" v-for="meal in foodPlan.meals" :key="meal.id">
      <MealCard :meal="meal" />
    </div>
  </div>
</template>

<script>
  import MealCard from "@/components/MealCard";
  import FoodplanService from "@/service/foodplan.service";

  export default {
    components: {MealCard},
    data() {
      return {
        foodPlan: null
      };
    },
    async created() {
      this.foodPlan = await FoodplanService.getFoodPlanById(Number(this.$route.params.id));
    }
  }
</script>
