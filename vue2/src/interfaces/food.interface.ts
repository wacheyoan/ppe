import {Category} from "@/interfaces/category.interface";

export interface Food {
  id: number;
  wording: string;
  createdAt: Date;
  updatedAt?: Date;
  carbohydrate: number;
  fat: number;
  protein: number;
  saturatedFat: number;
  sugar: number;
  vegan: boolean;
  category: Category[];
  calories: number;
  photo?: string;
}
