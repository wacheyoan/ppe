import Vue from 'vue'
import Vuex from 'vuex'
import { Meal } from "@/interfaces/meal.interface";
import mealService from "@/service/meal.service";
import createPersistedState from "vuex-persistedstate";
import auth from './modules/auth';
import {Activity} from "@/interfaces/activity.interface";
import activityService from "@/service/activity.service";
import {Objective} from "@/interfaces/objective.interface";
import objectiveService from "@/service/objective.service";
import foodService from '@/service/food.service';
import foodplanService from '@/service/foodplan.service';
import { FoodPlan } from '@/interfaces/foodplan.interface';

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    allMeals: [] as Meal[],
    allActivities: [] as Activity[],
    allObjectives: [] as Objective[],
    foodPlan: null as any ,
    auth: {
      isAuthenticated: false,
      user: null as any
    }
  },
  getters: {
    allMeals(state): Meal[]{
      return state.allMeals;
    },
    getAllActivities(state): Activity[]{
      return state.allActivities;
    },
    getAllObjectives(state): Objective[]{
      return state.allObjectives;
    },
  },
  mutations: {
    async updateGetterAllMeals(state) {
      state.allMeals = await mealService.getMealsNotLikedOrDisliked(state.auth.user.id);
    },
    async updateGetterAllActivities(state) {
      state.allActivities = await activityService.getAllActivities();
    },
    async updateGetterAllObjectives(state) {
      state.allObjectives = await objectiveService.getAllObjective();
    },
    async updateFoodPlan(state, payload: any) {
      state.foodPlan =  await foodplanService.updateFoodPlan(payload.userId, payload.nbMeal);
    }
  },
  actions: {
    async actionUpdateGetterAllMeals(context){
      context.commit("updateGetterAllMeals");
    },
    async actionUpdateGetterAllActivities(context){
      context.commit("updateGetterAllActivities");
    },
    async actionUpdateGetterAllObjectives(context){
      context.commit("updateGetterAllObjectives");
    },
    async generateFoodPlan(context, payload){
      context.commit("updateFoodPlan", payload);
    }
  },
  modules: {
    auth
  },
  plugins: [createPersistedState()]
})
