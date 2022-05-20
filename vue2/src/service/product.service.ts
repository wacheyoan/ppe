import {Product} from "@/interfaces/product.interface";
import ProductRepository from "@/repository/product.repository";
import ProductFactory from "@/factory/product.factory";

export default {
    async getProductByEAN(ean:string): Promise<Product| null> {
        const rawProduct = await ProductRepository.getProductByEAN(ean);
        if(undefined !== rawProduct.product)
        {
            return ProductFactory.formatRawProductToProduct(rawProduct.product);
        }else{
            return null;
        }
    }
}
