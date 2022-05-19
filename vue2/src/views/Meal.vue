<template>
  <div class="main-container">
    <v-btn @click="$router.back()" >
      <v-icon color="white">mdi-arrow-left-top</v-icon>
    </v-btn>
    <div v-if="meal">
      <v-img
        :src="require(`../../src/assets/images/${meal.photo ? meal.photo : 'logo.jpg'}`)"
        aspect-ratio="1"
      >
      </v-img>
    </div>
    <div v-if="meal" class="macro-container">
      <span>
        {{meal.calories | formatNumberAfterDecimal}} Kcal
        <small>Calories</small>
      </span>
      <span>
        {{meal.carbohydrates | formatNumberAfterDecimal}} g
         <small>Glucides</small>
      </span>
      <span>
        {{meal.proteins | formatNumberAfterDecimal}} g
        <small>Protéines</small>
      </span>
      <span>
        {{meal.fats | formatNumberAfterDecimal}} g
        <small>Lipides</small>
      </span>
    </div>
    <div class="food-container" v-if="meal">
      <div v-for="(food,i) in meal.foods" class="food"
           :key="i">
        <span>
          <v-btn
              text plain
              class="text-lowercase"
              :to="{ name: 'Food', params: { id: food.id }}"
          >
            {{food.wording}}
         </v-btn>
        </span>
        <span>{{food.calories | formatNumberAfterDecimal}} Kcal</span>
      </div>
    </div>
    <div v-if="meal">
      <h3>Valeurs nutritives</h3>
      <div class="food-container">
        <div>
          <span>Calories</span>
          <span>{{meal.calories | formatNumberAfterDecimal}} Kcal</span>
        </div>
        <div>
          <span>Glucides</span>
          <span>{{meal.carbohydrates | formatNumberAfterDecimal}} g</span>
        </div>
        <div>
          <span>Dont sucre</span>
          <span>{{meal.sugar | formatNumberAfterDecimal}} g</span>
        </div>
        <div>
          <span>Protéines</span>
          <span>{{meal.proteins | formatNumberAfterDecimal}} g</span>
        </div>
        <div>
          <span>Lipides</span>
          <span>{{meal.fats | formatNumberAfterDecimal}} g</span>
        </div>
        <div>
          <span>Dont saturés</span>
          <span>{{meal.saturatedFat | formatNumberAfterDecimal}} g</span>
        </div>
      </div>
    </div>
  </div>
</template>


<script>

import MealService from "@/service/meal.service";

export default {
  data() {
    return {
      meal: null
    };
  },
  async created() {
    this.meal = await MealService.getMealById(Number(this.$route.params.id));
  }
}

</script>

<style scoped lang="scss">

.macro-container{
  display: flex;
  align-items: center;
  justify-content: space-between;
  &>span{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
}

.food-container{
  &>div{
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
}

.main-container,
.food-container
{
  display: flex;
  justify-content: center;
  gap: 24px;
  flex-direction: column;
}

.text-lowercase > span::first-letter{
    text-transform: capitalize;
}

.text-lowercase{
  padding: 0 !important;
  min-width: 0 !important;
}


</style>
