import { Utensil } from "@/interfaces/utensil.interface";

export default {
    formatRawUtensilToUtensil(rawUtensil: Readonly<any>): Utensil {
        return {
            id: rawUtensil.id,
            wording: rawUtensil.wording,
            createdAt: new Date(rawUtensil.createdAt),
        }
    }
}