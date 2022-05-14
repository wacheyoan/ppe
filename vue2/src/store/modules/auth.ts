import axios from 'axios';
import {Commit} from "vuex";
import loginService from "@/service/login.service";

const state:{user:string|null} = {
    user: null
};
const getters = {
    isAuthenticated:(state:{user:string|null}) => !!state.user,
    StateUser: (state:{user:string|null}) => state.user,
};
const actions = {
    // async Register({dispatch}, form) {
    //     await axios.post('register', form)
    //     const UserForm = new FormData()
    //     UserForm.append('username', form.username)
    //     UserForm.append('password', form.password)
    //     await dispatch('LogIn', UserForm)
    // },
    async LogIn({commit}: { commit: Commit }, User: FormData) {
        await axios.post('login', {email:User.get('username'), password:User.get('password')},{
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        await commit('setUser', User.get('username'))
    },
    async LogOut({commit}: { commit: Commit }){
        const user = null
        commit('LogOut', user)
    }
};
const mutations = {
    setUser(state:{user:string|null}, username:string){
        state.user = username
    },
    LogOut(state:{user:string|null}){
        state.user = null
    },
};
export default {
    state,
    getters,
    actions,
    mutations
};
