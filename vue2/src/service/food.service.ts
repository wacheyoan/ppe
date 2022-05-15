import foodRepository from "@/repository/food.repository";
import {Food} from "@/interfaces/food.interface";
import foodFactory from "@/factory/food.factory";

export default {
    async getAllFoods(): Promise<Food[]> {
        const rawFoods = await foodRepository.getAllFoods();
        const foods: Food[] = [];
        rawFoods['hydra:member'].forEach((rawFood: any) => {
            foods.push(foodFactory.formatRawFoodToFood(rawFood));
        })
        return foods;
    },
    async getFoodById(id: number): Promise<Food | null> {
        const rawFood = await foodRepository.getFoodById(id);
        if(rawFood["hydra:description"] === "Not Found"){
            console.error("Not found");
            return null;
        }else{
            return foodFactory.formatRawFoodToFood(rawFood);
        }
    },
    async addFood(food: Food): Promise<Food | null>{
        const response = await foodRepository.addFood(food);

        if(response["title"] === "An error occurred"){
            console.error(response["detail"]);
            return null;
        }else{
            return foodFactory.formatRawFoodToFood(response);
        }
    },
    async replaceFood(food: Food): Promise<Food | null>{
        const response = await foodRepository.replaceFood(food);

        if(response["title"] === "An error occurred"){
            console.error(response["detail"]);
            return null;
        }else{
            return foodFactory.formatRawFoodToFood(response);
        }
    },
    async updateFood(food: Food): Promise<Food | null>{
        const response = await foodRepository.updateFood(food);

        if(response["title"] === "An error occurred"){
            console.error(response["detail"]);
            return null;
        }else{
            return foodFactory.formatRawFoodToFood(response);
        }
    },
    async deleteFoodById(id: number): Promise<boolean>{
        const response = await foodRepository.deleteFoodById(id);

        if(response["title"] === "An error occurred"){
            console.error(response["detail"]);
            return false;
        }

        return true;
    }
}