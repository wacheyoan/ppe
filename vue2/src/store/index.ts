import Vue from 'vue'
import Vuex from 'vuex'
import { Meal } from "@/interfaces/meal.interface";
import mealService from "@/service/meal.service";
import loginService from "@/service/login.service";

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    allMeals: [] as Meal[],
  },
  getters: {
    allMeals(state): Meal[]{
      return state.allMeals;
    },
  },
  mutations: {
    async updateGetterAllMeals(state) {
      state.allMeals = await mealService.getAllMeals();
    },
  },
  actions: {
    async actionUpdateGetterAllMeals(context){
      context.commit("updateGetterAllMeals");
    },
    async login({state}, {email, password}: {email:string,password:string}){
      await loginService.login(email,password);
    }
  },
  modules: {},
})
