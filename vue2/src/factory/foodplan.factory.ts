import {FoodPlan} from "@/interfaces/foodplan.interface";
import {Meal} from "@/interfaces/meal.interface";
import userFactory from "@/factory/user.factory";
import periodFactory from "@/factory/period.factory";
import mealFactory from "@/factory/meal.factory";

export default {
    formatRawFoodPlanToFoodPlan(rawFoodPlan: Readonly<any>): FoodPlan {

        const meals: Meal[] = [];
        rawFoodPlan.meals.forEach((rawMeal:any) => {
            meals.push(mealFactory.formatRawMealToMeal(rawMeal))
        })

        return {
            id: rawFoodPlan.id,
            wording: rawFoodPlan.wording,
            meals: meals,
            user: userFactory.formatRawUserToUser(rawFoodPlan.user),
            period: periodFactory.formatRawPeriodToPeriod(rawFoodPlan.period),
            createdAt: new Date(rawFoodPlan.createdAt),
            updatedAt: new Date(rawFoodPlan.updatedAt)
        }
    }
}