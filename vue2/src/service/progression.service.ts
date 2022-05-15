import progressionRepository from "@/repository/progression.repository";
import progressionFactory from "@/factory/progression.factory";
import {Progression} from "@/interfaces/progression.interface";

export default {
    async getAllProgressions(){
        const rawProgression = await progressionRepository.getAllProgressions();
        const progressions: Progression[] = [];
        rawProgression['hydra:member'].forEach((rawProgression: any) => {
            progressions.push(progressionFactory.formatRawProgressionToProgression(rawProgression));
        })
        return progressions;
    }
}