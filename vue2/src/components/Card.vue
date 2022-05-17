<template>
  <v-card
      class="mx-auto"
      max-width="400"
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
      {{ foodPlan.calories }} Kcal
    </v-card-subtitle>

    <v-card-text class="text--primary">
      <div>
      {{
        foodPlan.meals.map(meal => meal.foods.map(food => food.wording).join(', ')).join('\n')
      }}
      </div>
    </v-card-text>

    <v-card-actions>

      <v-btn
          color="orange"
          text
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
