import { Food } from "@/interfaces/food.interface";
import categoryFactory from "@/factory/category.factory";
import {Category} from "@/interfaces/category.interface";

export default {
    formatRawFoodToFood(rawFood: Readonly<any>): Food {

        const categories: Category[] = [];
        rawFood.category.forEach((rawCategory:any) => {
            categories.push(categoryFactory.formatRawCategoryToCategory(rawCategory))
        })

        return {
            id: rawFood.id,
            wording: rawFood.wording,
            createdAt: new Date(rawFood.createdAt),
            updatedAt: new Date(rawFood.updatedAt) ?? null,
            carbohydrate: rawFood.carbohydrate,
            fat: rawFood.fat,
            protein: rawFood.protein,
            saturatedFat: rawFood.saturatedFat,
            sugar: rawFood.sugar,
            vegan: rawFood.vegan,
            category: categories,
            calories: (rawFood.carbohydrate * 4 + rawFood.fat * 9 + rawFood.protein * 4),
        }
    }
}
