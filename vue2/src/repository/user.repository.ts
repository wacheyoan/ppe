import {API} from "../../api-constants";

export default {
    async getAllusers(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/users`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the users call`);
        }

    }
}