import {Product} from "@/interfaces/product.interface";

export default {
    formatRawProductToProduct(rawProduct: Readonly<any>): Product {
        return {
           name: rawProduct.product_name,
            fat: rawProduct.nutriments.fat,
            carbohydrates: rawProduct.nutriments.carbohydrates,
            proteins: rawProduct.nutriments.proteins,
            sugars: rawProduct.nutriments.sugars,
            saturated_fat: rawProduct.nutriments['saturated-fat'],
            calories: rawProduct.nutriments["energy-kcal"],
        }
    }
}
