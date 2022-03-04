import {Objective} from "@/interfaces/objective.interface";

export default {
    formatRawObjectiveToObjective(rawObjective: Readonly<any>): Objective {
        return {
            id: rawObjective.id,
            wording: rawObjective.wording,
            createdAt: new Date(rawObjective.createdAt),
        }
    }
}