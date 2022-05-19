import recipeRepository from "@/repository/recipe.repository";
import recipeFactory from "@/factory/recipe.factory";
import {Recipe} from "@/interfaces/recipe.interface";

export default {
    async getAllRecipes() {
        const rawRecipes = await recipeRepository.getAllRecipes();
        const recipes: Recipe[] = [];
        rawRecipes['hydra:member'].forEach((rawRecipe: any) => {
            recipes.push(recipeFactory.formatRawRecipeToRecipe(rawRecipe));
        })
        return recipes;
    },
    async getRecipeById(id: number) {
        const rawRecipe = await recipeRepository.getRecipeById(id);
        return recipeFactory.formatRawRecipeToRecipe(rawRecipe['hydra:member'][0]);
    },
}
