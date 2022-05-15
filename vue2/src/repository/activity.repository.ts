import {API} from "../../api-constants";

export default {
    async getAllActivities(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/activities`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the activities call`);
        }

    }
}