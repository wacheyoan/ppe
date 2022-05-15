import utensilRepository from "@/repository/utensil.repository";
import {Utensil} from "@/interfaces/utensil.interface";
import utensilFactory from "@/factory/utensil.factory";

export default {
    async getAllUtensils(): Promise<Utensil[]> {
        const rawUtensils = await utensilRepository.getAllUtensils();
        const utensils: Utensil[] = [];
        rawUtensils['hydra:member'].forEach((rawUtensil: any) => {
            utensils.push(utensilFactory.formatRawUtensilToUtensil(rawUtensil));
        })
        return utensils;
    }
}