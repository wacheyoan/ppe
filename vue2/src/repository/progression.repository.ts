import {API} from "../../api-constants";

export default {
    async getAllProgressions(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/progressions`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the progressions call`);
        }

    }
}