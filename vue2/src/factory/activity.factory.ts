import {Activity} from "@/interfaces/activity.interface";

export default {
    formatRawActivityToActivity(rawActivity: Readonly<any>): Activity {
        return {
            id: rawActivity.id,
            wording: rawActivity.wording,
            coefficient: rawActivity.coefficient
        }
    }
}