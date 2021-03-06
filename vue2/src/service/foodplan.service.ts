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
    },
    async updateFoodPlan(userId:number, nbMeal: number) {
        const response = await foodPlanRepository.updateFoodPlan(userId, nbMeal);

        if(response["title"] === "An error occurred"){
            console.error(response["detail"]);
            return null;
        }
    },
    async getFoodPlansOfUser(userId: number): Promise<FoodPlan[]> {
        const rawFoodPlans = await foodPlanRepository.getFoodPlansOfUser(userId);
        const foodPlans: FoodPlan[] = [];
        rawFoodPlans['hydra:member'].forEach((rawFoodPlan: any) => {
            foodPlans.push(foodPlanFactory.formatRawFoodPlanToFoodPlan(rawFoodPlan));
        })
        return foodPlans;
    },
    async getFoodPlanById(foodPlanId: number): Promise<FoodPlan> {
        const rawFoodPlan = await foodPlanRepository.getFoodPlanById(foodPlanId);
        return foodPlanFactory.formatRawFoodPlanToFoodPlan(rawFoodPlan);
    },
}
