import axios from 'axios';
import {Commit} from "vuex";
import {User} from "@/interfaces/user.interface";
import userService from "@/service/user.service";

const state:{user:User|null} = {
    user: null
};
const getters = {
    isAuthenticated:(state:{user:User|null}) => !!state.user,
    StateUser: (state:{user:User|null}) => state.user,
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
        const user = await userService.getUserByEmail(User.get('username') as string);
        await commit('setUser', user);
    },
    async LogOut({commit}: { commit: Commit }){
        const user = null
        commit('LogOut', user)
    }
};
const mutations = {
    setUser(state:{user:User|null}, user:User){
        state.user = user
    },
    LogOut(state:{user:User|null}){
        state.user = null
    },
};
export default {
    state,
    getters,
    actions,
    mutations
};
