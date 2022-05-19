<template>
  <v-card
      class="mx-auto"
      max-width="400"
      rounded="xl"
  >
    <v-carousel
        hide-delimiters
        height="250"
    >
      <v-carousel-item
          v-for="(meal,i) in foodPlan.meals"
          :key="i"
          :src="require(`../../src/assets/images/${meal.photo ? meal.photo : 'logo.png'}`)"
      ></v-carousel-item>
    </v-carousel>

    <v-card-subtitle class="pb-0">
      {{ foodPlan.calories | formatNumberAfterDecimal}} Kcal
    </v-card-subtitle>

    <v-card-text class="text--primary">
      <div class="meals">
      {{
        foodPlan.meals.map(meal => meal.foods.map(food => food.wording).join(', ')).join('\n')
      }}
      </div>
    </v-card-text>

    <v-card-actions>

      <v-btn
          color="orange"
          text
          :to="{ name: 'Foodplan', params: { id: foodPlan.id }}"
      >
        Voir le plan alimentaire
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    props:['foodPlan']
  }
</script>

<style scoped >
.meals {
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
}
</style>
