import {Step} from "@/interfaces/step.interface";
import {Utensil} from "@/interfaces/utensil.interface";

export interface Recipe {
  id: number;
  wording: string;
  createdAt: Date;
  steps: Step[];
  utensils: Utensil[];
}
