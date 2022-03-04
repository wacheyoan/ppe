import {API} from "../../api-constants";

export default {
    async getAllFoodPlans(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/food_plans`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the food_plans call`);
        }

    }
}