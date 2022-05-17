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
            period: rawFoodPlan.period ? periodFactory.formatRawPeriodToPeriod(rawFoodPlan.period) : null,
            createdAt: new Date(rawFoodPlan.createdAt),
            updatedAt: new Date(rawFoodPlan.updatedAt),
            calories: meals.reduce((acc, meal) => acc + meal.calories, 0),
        }
    }
}
