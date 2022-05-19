import { Meal } from "@/interfaces/meal.interface";
import { Food } from "@/interfaces/food.interface";
import recipeFactory from '@/factory/recipe.factory';
import foodFactory from "@/factory/food.factory";

export default {
    formatRawMealToMeal(rawMeal: Readonly<any>): Meal {

        const foods: Food[] = [];
        rawMeal.foods.forEach((rawFood:any) => {
            foods.push(foodFactory.formatRawFoodToFood(rawFood))
        })


        return {
            id: rawMeal.id,
            wording: rawMeal.wording,
            createdAt: new Date(rawMeal.createdAt),
            foods: foods,
            recipe: rawMeal.recipe ? recipeFactory.formatRawRecipeToRecipe(rawMeal.recipe) : null,
            photo: rawMeal.photo ? rawMeal.photo.replace(' ','') : null,
            calories: foods.reduce((acc, food) => acc + food.calories, 0),
            proteins: foods.reduce((acc, food) => acc + food.protein, 0),
            carbohydrates: foods.reduce((acc, food) => acc + food.carbohydrate, 0),
            fats: foods.reduce((acc, food) => acc + food.fat, 0),
            saturatedFat: foods.reduce((acc, food) => acc + food.saturatedFat, 0),
            sugar: foods.reduce((acc, food) => acc + food.sugar, 0),
        }
    }
}
