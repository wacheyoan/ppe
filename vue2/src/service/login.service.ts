import {API} from "../../api-constants";

export default {
    async login(email:string,password:string) {
        try {
            const httpCall = await fetch(`${API}/login`,{
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            })
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the login call`);
        }
    }
}
