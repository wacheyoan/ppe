import {API} from "../../api-constants";
import {FoodPlan} from "@/interfaces/foodplan.interface";

export default {
    async getAllFoodPlans(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/food_plans`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the food_plans call`);
        }

    },
    async getFoodPlanById(id: number): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/food_plans/${id}`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the food_plans call`);
        }
    },
    async updateFoodPlan(userId:number, nbMeal: number): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/foodplan/generate/${userId}`, {
                method: 'POST', 
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    nbMeal: nbMeal
                })
            })
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the food_plans call`);
        }
    },
    async getFoodPlansOfUser(userId:number): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/food_plans?userId=${userId}`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the food_plans call`);
        }
    },
}
