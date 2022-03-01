<template>
  <div>
    <li v-for="meal in this.meals" :key="meal.id">
      {{meal.wording}}
    </li>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from "vue-class-component";
import MealService from "@/service/meal.service";

@Options({
  props: {
    msg: String,
  },
  data(){
    return {
      meals: []
    }
  },
  async mounted() {
    this.getAllMeals();
  },
  methods: {
    async getAllMeals() {
      this.meals = await MealService.getAllMeals();
    },
  },
})
export default class HelloWorld extends Vue {
  msg!: string;
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
