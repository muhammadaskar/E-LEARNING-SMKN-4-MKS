import { createStore } from "vuex"
import axiosClient from "../axios"

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem('TOKEN'),
            role: sessionStorage.getItem('ROLE'),
        }
    },
    getters: {},
    actions: {
        register({ commit }, user) {
            return axiosClient.post('/register', user)
                .then(({ data }) => {
                    commit('setUser', data.user);
                    commit('setToken', data.token)
                    commit('setRole', data.role)
                    console.log(data)
                    return data;
                })
        },
        login({ commit }, user) {
            return axiosClient.post('/login', user)
                .then(({ data }) => {
                    commit('setToken', data.token)
                    commit('setUser', data.user)
                    commit('setRole', data.role)
                    return data;
                })
        },
        logout({ commit }) {
            return axiosClient.post('/logout')
                .then((res) => {
                    commit('logout')
                    return res
                })
        },

        saveTeacherAccount({ }, teacher) {
            // delete teacher.foto_url
            let response = axiosClient.post('/admin-teacher', teacher)
                .then((res) => {
                    console.log(res)
                    return res;
                });
            return response;

        }
    },
    mutations: {

        setUser: (state, user) => {
            state.user.data = user;
        },
        setToken: (state, token) => {
            state.user.token = token;
            sessionStorage.setItem('TOKEN', token);
        },
        setRole: (state, role) => {
            state.user.role = role;
            sessionStorage.setItem('ROLE', role);
        },
        logout: (state) => {
            state.user.data = {}
            state.user.token = null
            sessionStorage.removeItem('TOKEN')
            sessionStorage.removeItem('ROLE')
        },
    },
    modules: {}
})

export default store