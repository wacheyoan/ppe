import {Progression} from "@/interfaces/progression.interface";

export default {
    formatRawProgressionToProgression(rawProgression: Readonly<any>): Progression {
        return {
            id: rawProgression.id,
            weight: rawProgression.weight,
            createdAt: new Date(rawProgression.createdAt),
            date: new Date(rawProgression.date),
            updatedAt: new Date(rawProgression.updatedAt)
        }
    }
}