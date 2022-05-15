import foodPlanRepository from "@/repository/foodplan.repository";
import foodPlanFactory from "@/factory/foodplan.factory";
import {FoodPlan} from "@/interfaces/foodplan.interface";

export default {
    async getAllFoodPlans(): Promise<FoodPlan[]> {
        const rawFoodPlans = await foodPlanRepository.getAllFoodPlans();
        const foodPlans: FoodPlan[] = [];
        rawFoodPlans['hydra:member'].forEach((rawFoodPlan: any) => {
            foodPlans.push(foodPlanFactory.formatRawFoodPlanToFoodPlan(rawFoodPlan));
        })
        return foodPlans;
    }
}