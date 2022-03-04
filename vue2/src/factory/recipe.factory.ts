import stepFactory from "@/factory/step.factory";
import utensilFactory from "@/factory/utensil.factory";
import {Recipe} from "@/interfaces/recipe.interface";
import {Step} from "@/interfaces/step.interface";
import {Utensil} from "@/interfaces/utensil.interface";

export default {
    formatRawRecipeToRecipe(rawFood: Readonly<any>): Recipe {

        const steps: Step[] = [];
        rawFood.steps.forEach((rawStep:any) => {
            steps.push(stepFactory.formatRawStepToStep(rawStep))
        })

        const utensils: Utensil[] = [];
        rawFood.utensils.forEach((rawUtensil:any) => {
            utensils.push(utensilFactory.formatRawUtensilToUtensil(rawUtensil))
        })

        return {
            id: rawFood.id,
            wording: rawFood.wording,
            createdAt: new Date(rawFood.createdAt),
            steps: steps,
            utensils: utensils
        }
    }
}