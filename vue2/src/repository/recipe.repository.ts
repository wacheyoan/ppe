import {API} from "../../api-constants";

export default {
    async getAllRecipes(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/recipes`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the rawRecipes call`);
        }

    }
}