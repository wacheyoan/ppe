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
    },
    async getMealById(mealId: number): Promise<Meal>{
        const rawMeal = await mealRepository.getMealById(mealId);
        return mealFactory.formatRawMealToMeal(rawMeal['hydra:member'][0]);
    },
    async getMealsNotLikedOrDisliked(user: number): Promise<Meal[]> {
        const rawMeals = await mealRepository.getMealsNotLikedOrDisliked(user);
        const meals: Meal[] = [];
        rawMeals['hydra:member'].forEach((rawMeal: any) => {
            meals.push(mealFactory.formatRawMealToMeal(rawMeal));
        })
        return meals;
    },
    async getMealsLiked(user: number): Promise<Meal[]> {
        const rawMeals = await mealRepository.getMealsLiked(user);
        const meals: Meal[] = [];
        rawMeals['hydra:member'].forEach((rawMeal: any) => {
            meals.push(mealFactory.formatRawMealToMeal(rawMeal));
        })
        return meals;
    },
    async getMealsDisliked(user: number): Promise<Meal[]> {
        const rawMeals = await mealRepository.getMealsDisLiked(user);
        const meals: Meal[] = [];
        rawMeals['hydra:member'].forEach((rawMeal: any) => {
            meals.push(mealFactory.formatRawMealToMeal(rawMeal));
        })
        return meals;
    },
    async likeMeal(mealId: number,user:number): Promise<boolean> {
        return await mealRepository.likeMeal(mealId,user);
    },
    async dislikeMeal(mealId: number,user:number): Promise<boolean> {
        return await mealRepository.dislikeMeal(mealId,user);
    },
}
