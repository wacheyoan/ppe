<template>
  <div class="main-container">
    <div class="row">
      <div>
      <v-btn
          elevation="7"
          x-large
          height="80"
          :color="filterFood ? 'grey' : ''"
          @click="filterFoodF"
      >
        <v-img
            :src="require(`../../src/assets/images/food.svg`)"
            width="50"
        ></v-img>
      </v-btn>
      <small>Aliments</small>
      </div>
      <div>
      <v-btn
          elevation="7"
          x-large
          height="80"
          :color="filterMeal ? 'grey' : ''"
          @click="filterMealF"
      >
        <v-img
            :src="require(`../../src/assets/images/meal.svg`)"
            width="50"

        ></v-img>
      </v-btn>
      <small>Repas</small>
    </div>
    </div>
    <v-divider></v-divider>
    <ul>
      <li v-for="(item,i) in aliments" :key="i">
        <span>{{ item.wording }}</span>
        <span>{{ item.calories | formatNumberAfterDecimal }} Kcal
          <v-btn
              v-if="undefined !== item.recipe"
              color="transparent"
              :to="`/cooking/${item.recipe.id}`"
          >
            <v-icon>
            mdi-chef-hat
            </v-icon>
          </v-btn>
        </span>
      </li>
    </ul>
  </div>
</template>

<script>

import MealService from "@/service/meal.service";
import FoodService from "@/service/food.service";

export default {
  name: 'All',
  data() {
    return {
      aliments: [],
      filterFood: true,
      filterMeal: true,
    }
  },
  methods: {
    async getAllMeals() {
      return await MealService.getAllMeals();
    },
    async getAllFoods() {
      return await FoodService.getAllFoods();
    },
    async getAll() {

      this.aliments = [];

      if(this.filterFood) {
        this.aliments = this.aliments.concat(await this.getAllFoods());
      }
      if(this.filterMeal) {
        this.aliments = this.aliments.concat(await this.getAllMeals());
      }
    },
    filterFoodF() {
      this.filterFood = !this.filterFood;
      this.getAll();
    },
    filterMealF() {
      this.filterMeal = !this.filterMeal;
      this.getAll();
    }

  },
  async mounted() {
      await this.getAll();
  }
}

</script>


<style scoped lang="scss">

ul li{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
ul{
  display: flex;
  flex-direction: column;
  gap: 16px;
  padding: 0;
}

.row{
  gap: 24px;
  position: sticky;
  top: 16px;
  >div{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }
}

.main-container
{
  display: flex;
  flex-direction: column;
  gap: 24px;
}


</style>
