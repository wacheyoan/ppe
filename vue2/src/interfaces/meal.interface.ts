import {Food} from "@/interfaces/food.interface";
import {Recipe} from "@/interfaces/recipe.interface";

export interface Meal {
  id: number;
  wording: string;
  createdAt: Date;
  foods: Food[];
  recipe: Recipe | null;
  photo: string | null;
  calories: number;
  carbohydrates: number;
  proteins: number;
  fats: number;
  sugar: number;
  saturatedFat: number;
}
