<template>
  <div>

  </div>
</template>

<script>


import RecipeService from "@/service/recipe.service";

export default {
  data() {
    return {
      recipe: null
    };
  },
  async created() {
    this.recipe = await RecipeService.getRecipeById(Number(this.$route.params.id));
  }

}
</script>
