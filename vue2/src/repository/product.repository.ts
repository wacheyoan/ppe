import {APIEAN} from "../../api-constants";

export default {
    async getProductByEAN(ean:string): Promise<any> {
        try {
            const httpCall = await fetch(`${APIEAN}${ean}`);
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the periods call`);
        }

    }
}
