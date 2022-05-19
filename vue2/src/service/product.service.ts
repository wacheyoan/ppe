import {Product} from "@/interfaces/product.interface";
import ProductRepository from "@/repository/product.repository";
import ProductFactory from "@/factory/product.factory";

export default {
    async getProductByEAN(ean:string): Promise<Product> {
        const rawProduct = await ProductRepository.getProductByEAN(ean);
        return ProductFactory.formatRawProductToProduct(rawProduct);
    }
}
