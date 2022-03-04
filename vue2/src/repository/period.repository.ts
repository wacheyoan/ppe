import {API} from "../../api-constants";

export default {
    async getAllPeriods(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/periods`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the periods call`);
        }

    }
}