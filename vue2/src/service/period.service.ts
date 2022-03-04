import periodRepository from "@/repository/period.repository";
import periodFactory from "@/factory/period.factory";
import {Period} from "@/interfaces/period.interface";

export default {
    async getAllPeriods(): Promise<Period[]> {
        const rawPeriods = await periodRepository.getAllPeriods();
        const periods: Period[] = [];
        rawPeriods['hydra:member'].forEach((rawPeriod: any) => {
            periods.push(periodFactory.formatRawPeriodToPeriod(rawPeriod));
        })
        return periods;
    }
}