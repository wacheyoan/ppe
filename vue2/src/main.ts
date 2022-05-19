import Vue from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import axios from 'axios';
import {API} from "../api-constants";

Vue.config.productionTip = false
axios.defaults.withCredentials = true;
axios.defaults.baseURL = API;

Vue.filter('formatNumberAfterDecimal', function (value:number) {
    return parseFloat(value.toFixed(2));
});

Vue.filter('ageFromBirthDate',function (birthDate:string) {
    const today = new Date();
    const birthDateDate = new Date(birthDate);
    const birthDateYear = birthDateDate.getFullYear();
    const birthDateMonth = birthDateDate.getMonth();
    const birthDateDay = birthDateDate.getDate();
    let age = today.getFullYear() - birthDateYear;
    const m = today.getMonth() - birthDateMonth;
    const d = today.getDate() - birthDateDay;
    if (m < 0 || (m === 0 && d < 0)) {
        age--;
    }
    return age;

});

axios.interceptors.response.use(undefined, function (error) {
  if (error) {
    const originalRequest = error.config;
    if (error.response.status === 401 && !originalRequest._retry) {

      originalRequest._retry = true;
      store.dispatch('LogOut')
      return router.push('/login')
    }
  }
})

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
