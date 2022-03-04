import mealFactory from "@/factory/meal.factory";
import { Meal } from "@/interfaces/meal.interface";
import mealRepository from "@/repository/meal.repository";

export default {
    async getAllMeals(): Promise<Meal[]> {
        const rawMeals = await mealRepository.getAllMeals();
        const meals: Meal[] = [];
        rawMeals['hydra:member'].forEach((rawMeal: any) => {
            meals.push(mealFactory.formatRawMealToMeal(rawMeal));
        })
        return meals;
    }
}