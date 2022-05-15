import {API} from "../../api-constants";
import mealService from "@/service/meal.service";

export default {
    async getAllMeals(): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/meals`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the meal call`);
        }

    },
    async getMealsNotLikedOrDisliked(user:number): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/meals?disorliked=${user}`)
            return await httpCall.json();
        }
        catch (httpException) {
            console.log(httpException);
            throw new Error(`An error happened during the meal call`);
        }
    },
    async getMealsLiked(user: number): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/meals?userLike.id=${user}`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the meal call`);
        }
    },
    async getMealsDisLiked(user: number): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/meals?userDislike.id=${user}`)
            return await httpCall.json();
        }
        catch (httpException) {
            throw new Error(`An error happened during the meal call`);
        }
    },
    async likeMeal(mealId: number,userId:number): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/meals/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    mealId: mealId,
                    userId:userId
                })
            })
            return await httpCall.json();
        }
        catch (httpException) {
            console.log(httpException);
            throw new Error(`An error happened during the meal call`);
        }
    },
    async dislikeMeal(mealId: number,userId:number): Promise<any> {
        try {
            const httpCall = await fetch(`${API}/meals/dislike`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    mealId: mealId,
                    userId:userId
                })
            })
            return await httpCall.json();
        }
        catch (httpException) {
            console.log(httpException);
            throw new Error(`An error happened during the meal call`);
        }
    },
}
