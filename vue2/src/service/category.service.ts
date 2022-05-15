import categoryRepository from "@/repository/category.repository";
import {Category} from "@/interfaces/category.interface";
import categoryFactory from "@/factory/category.factory";

export default {
    async getAllMeals(): Promise<Category[]> {
        const rawCategories = await categoryRepository.getAllCategories();
        const categories: Category[] = [];
        rawCategories['hydra:member'].forEach((rawCategory: any) => {
            categories.push(categoryFactory.formatRawCategoryToCategory(rawCategory));
        })
        return categories;
    }
}