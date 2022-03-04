import stepRepository from "@/repository/step.repository";
import stepFactory from "@/factory/step.factory";
import {Step} from "@/interfaces/step.interface";

export default {
    async getAllSteps(): Promise<Step[]> {
        const rawSteps = await stepRepository.getAllSteps();
        const steps: Step[] = [];
        rawSteps['hydra:member'].forEach((rawStep: any) => {
            steps.push(stepFactory.formatRawStepToStep(rawStep));
        })
        return steps;
    }
}