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

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    allMeals: [] as Meal[],
    allActivities: [] as Activity[],
    allObjectives: [] as Objective[],
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
      state.allMeals = await mealService.getMealsNotLikedOrDisliked(this.state.auth.user.id);
    },
    async updateGetterAllActivities(state) {
      state.allActivities = await activityService.getAllActivities();
    },
    async updateGetterAllObjectives(state) {
      state.allObjectives = await objectiveService.getAllObjective();
    },
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
  },
  modules: {
    auth
  },
  plugins: [createPersistedState()]
})
