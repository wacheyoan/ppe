import {API} from "../../api-constants";
import {Food} from "@/interfaces/food.interface";

export default {
    async getAllFoods(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/food`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the food call`);
        }
    },
    async getFoodById(id: number): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/food/${id}`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the food call by id`);
        }
    },
    async addFood(food: Food): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/food`,{
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(food)
            })
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the post add food call`);
        }
    },
    async replaceFood(food: Food): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/food/${food.id}`,{
                method: "PUT",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(food)
            })
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the replace food call`);
        }
    },
    async updateFood(food: Food): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/food/${food.id}`,{
                method: "PATCH",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/merge-patch+json'
                },
                body: JSON.stringify(food)
            })
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the patch food call`);
        }
    },
    async deleteFoodById(id: number): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/food/${id}`,{
                method: "DELETE"
            })
            return await httpCall.text();
        }
        catch (httpException) {
            console.error(httpException)
            throw new Error(`An error happened during the delete food call`);
        }
    }
}