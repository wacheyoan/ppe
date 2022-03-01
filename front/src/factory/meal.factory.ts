import { Meal } from "@/interfaces/meal.interface";

export default {
    formatRawMealToMeal(rawMeal: Readonly<any>): Meal {
        return {
            id: rawMeal.id,
            wording: rawMeal.wording,
            createdAt: new Date(rawMeal.createdAt),
            foods: rawMeal.foods,
            recipe: rawMeal.recipe,
            foodPlans: rawMeal.foodPlans
        }
    }
}