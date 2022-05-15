import { Category } from "@/interfaces/category.interface";

export default {
    formatRawCategoryToCategory(rawCategory: Readonly<any>): Category {
        return {
            id: rawCategory.id,
            wording: rawCategory.wording,
            createdAt: new Date(rawCategory.createdAt),
        }
    }
}