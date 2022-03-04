import { API } from "../../api-constants";

export default {
    async getAllMeals(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/meals`)
            const rawMeals = await httpCall.json()
            return rawMeals;
        }
        catch (httpException) {
            throw new Error(`An error happened during the meal call`);
        }

    }
}