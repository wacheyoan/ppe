import {API} from "../../api-constants";

export default {
    async getAllUtensils(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/utensils`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the utensil call`);
        }

    }
}