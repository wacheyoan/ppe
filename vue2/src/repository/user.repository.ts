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

    },
    async getUserByEmail(email: string): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/users?email=${email}`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the user call`);
        }
    },

}
