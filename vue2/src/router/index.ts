import Vue from 'vue'
import VueRouter, { RouteConfig } from 'vue-router'
import Home from '../views/Home.vue'
import store from "@/store";

Vue.use(VueRouter)

const routes: Array<RouteConfig> = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    meta: {requiresAuth: true}
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('../views/Login.vue'),
    meta: { guest: true }
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('../views/Register.vue'),
    meta: { guest: true }
  },
  {
    path: '/foodplan',
    name: 'FoodplanIndex',
    component: () => import('../views/Cook.vue'),
    meta: {requiresAuth: true}
  },
  {
    path: '/profil',
    name: 'Profil',
    component: () => import('../views/Profil.vue'),
    meta: {requiresAuth: true}
  },
  {
    path: '/foodplan/:id',
    name: 'Foodplan',
    component: () => import('../views/FoodPlan.vue'),
    meta: {requiresAuth: true}
  },
  {
    path: '/aliments/meals/:id',
    name: 'Meal',
    component: () => import('../views/Meal.vue'),
    meta: {requiresAuth: true}
  },
  {
    path: '/aliments/foods/:id',
    name: 'Food',
    component: () => import('../views/Food.vue'),
    meta: {requiresAuth: true},
  },
  {
    path: '/aliments',
    name: 'All',
    component: () => import('../views/All.vue'),
    meta: {requiresAuth: true}
  },
  {
    path: '/cooking/:id',
    name: 'Cooking',
    component: () => import('../views/Cooking.vue'),
    meta: {requiresAuth: true}
  }

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.requiresAuth)) {
    if (store.getters.isAuthenticated) {
      next()
      return
    }
    next('/login')
  } else {
    next()
  }
})

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.guest)) {
    if (store.getters.isAuthenticated) {
      next("/");
      return;
    }
    next();
  } else {
    next();
  }
});

export default router
