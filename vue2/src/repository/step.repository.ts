import {API} from "../../api-constants";

export default {
    async getAllSteps(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/steps`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the food call`);
        }

    }
}