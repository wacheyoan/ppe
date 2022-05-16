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
    async updateFoodPlan(userId:number, nbMeal: number): Promise<FoodPlan | null> {
        const response = await foodPlanRepository.updateFoodPlan(userId, nbMeal);

        if(response["title"] === "An error occurred"){
            console.error(response["detail"]);
            return null;
        }else{
            return foodPlanFactory.formatRawFoodPlanToFoodPlan(response);
        }
    }
}