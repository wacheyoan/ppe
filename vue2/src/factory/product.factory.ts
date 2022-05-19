import {Product} from "@/interfaces/product.interface";

export default {
    formatRawProductToProduct(rawProduct: Readonly<any>): Product {
        return {
           brand_name: rawProduct.brand_name,
           name: rawProduct.name,
           gtin14: rawProduct.gtin14,
           size: rawProduct.size
        }
    }
}
