import {API} from "../../api-constants";

export default {
    async getAllCategories(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/food_categories`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the food categories call`);
        }

    }
}