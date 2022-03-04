import {Meal} from "@/interfaces/meal.interface";
import {User} from "@/interfaces/user.interface";
import {Period} from "@/interfaces/period.interface";

export interface FoodPlan {
  id: number;
  wording: string;
  meals: Meal[];
  user: User;
  period: Period;
  createdAt: Date;
  updatedAt?: Date | null;
}
