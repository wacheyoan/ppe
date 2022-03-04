import {API} from "../../api-constants";

export default {
    async getAllObjective(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/objectives`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the objectives call`);
        }

    }
}