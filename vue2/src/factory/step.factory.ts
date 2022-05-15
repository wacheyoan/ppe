import {Step} from "@/interfaces/step.interface";

export default {
    formatRawStepToStep(rawFood: Readonly<any>): Step {
        return {
            id: rawFood.id,
            wording: rawFood.wording,
            createdAt: new Date(rawFood.createdAt),
            updatedAt: new Date(rawFood.updatedAt) ?? null,
        }
    }
}