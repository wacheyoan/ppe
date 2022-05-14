<template>
    <div class="cook">
      <div class="cards" v-for="meal in meals" :key="meal.id">
        <Card :meal="meal" />
      </div>
      <v-btn>
          elevation="2"
          large
      >Générer le plan</v-btn>
    </div>
</template>

<script>
import Card from "@/components/Card";
export default {
  components: {Card},
  data() {
    return {
      meals: []
    };
  }
}
</script>
