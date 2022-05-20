<template>
  <v-card
      class="mx-auto"
      max-width="400"
      rounded="l"
  >

    <v-carousel
        hide-delimiters
        height="250"
    >
      <v-carousel-item
          v-for="(food,i) in meal.foods"
          :key="i"
          :src="require(`../../src/assets/images/${food.photo ? food.photo : 'logo.png'}`)"
          contain
      ></v-carousel-item>
    </v-carousel>

    <v-card-subtitle class="pb-0">
      {{ meal.calories | formatNumberAfterDecimal}} Kcal
    </v-card-subtitle>

    <v-card-text class="text--primary">
      <div>
        {{
          meal.foods.map(food => food.wording).join(', ')
        }}
      </div>
    </v-card-text>

    <v-card-actions>

      <v-btn
          color="orange"
          text
          :to="`/aliments/meals/${meal.id}`"
      >
        Voir le repas
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  props:['meal']
}
</script>
