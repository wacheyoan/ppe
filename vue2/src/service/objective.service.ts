import objectiveRepository from "@/repository/objective.repository";
import objectiveFactory from "@/factory/objective.factory";
import {Objective} from "@/interfaces/objective.interface";

export default {
    async getAllObjective(): Promise<Objective[]> {
        const rawObjectives = await objectiveRepository.getAllObjective();
        const objectives: Objective[] = [];
        rawObjectives['hydra:member'].forEach((rawObjective: any) => {
            objectives.push(objectiveFactory.formatRawObjectiveToObjective(rawObjective));
        })
        return objectives;
    }
}