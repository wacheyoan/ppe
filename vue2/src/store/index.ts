import Vue from 'vue'
import Vuex from 'vuex'
import { Meal } from "@/interfaces/meal.interface";
import mealService from "@/service/meal.service";
import loginService from "@/service/login.service";
import createPersistedState from "vuex-persistedstate";
import auth from './modules/auth';

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
      const response = await loginService.login(email,password);

      if(response.status === 401){
        return response.message;
      }

      if(response.token){
        localStorage.setItem("token", response.token);
      }
    },
    async logout(){
      localStorage.removeItem("token");
    }
  },
  modules: {
    auth
  },
  plugins: [createPersistedState()]
})
