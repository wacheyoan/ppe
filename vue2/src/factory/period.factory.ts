import {Period} from "@/interfaces/period.interface";

export default {
    formatRawPeriodToPeriod(rawPeriod: Readonly<any>): Period {
        return {
            id: rawPeriod.id,
            start: new Date(rawPeriod.start),
            end:  new Date(rawPeriod.end),
            createdAt: new Date(rawPeriod.createdAt)
        }
    }
}