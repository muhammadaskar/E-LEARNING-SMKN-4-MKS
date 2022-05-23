import { createStore } from "vuex"
import axiosClient from "../axios"

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem('TOKEN'),
            role: sessionStorage.getItem('ROLE'),
        },
        teachers: {
            data: {},
            loading: false
        },
        students: {
            data: {},
            loading: false
        },
        parents: {
            data: {},
            loading: false
        },
        currentTeacher: {
            data: {},
            loading: false
        },
        currentStudent: {
            data: {},
            loading: false
        },
        currentParent: {
            data: {},
            loading: false
        },
        notification: {
            show: false,
            type: 'success',
            message: ''
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
        },
        editTeacherAccount({ }, teacher) {
            // delete teacher.foto_url
            let response = axiosClient.put(`/admin-teacher/${teacher.user_id}`, teacher)
                .then((res) => {
                    console.log(res)
                    return res;
                });
            return response;
        },
        getTeachersAccount({ commit }) {
            commit("setTeacherLoading", true)
            return axiosClient.get('/admin-teacher').then((res) => {
                commit("setTeacherLoading", false)
                commit("setTeachersAccount", res.data)
                console.log(res.data)
                return res
            })
                .catch((err) => {
                    console.log(err)
                })
        },
        getTeacherAccount({ commit }, id) {
            return axiosClient
                .get(`/admin-teacher/${id}`)
                .then((res) => {
                    commit("setCurrentTeacher", res.data)
                    // console.log(res.data)
                    return res
                })
        },
        deleteTeacherAccount({ commit }, id) {
            return axiosClient.delete(`/admin-teacher/${id}`).then((res) => {
                return res
            })
        },

        saveStudentAccount({ commit }, student) {
            let response = axiosClient.post('/admin-student', student)
                .then((res) => {
                    console.log(res)
                    return res;
                });
            return response;
        },
        getStudentsAccount({ commit }) {
            commit("setStudentLoading", true)
            return axiosClient.get('/admin-student').then((res) => {
                commit("setStudentLoading", false)
                commit("setStudentsAccount", res.data)
                console.log(res.data)
                return res
            })
                .catch((err) => {
                    console.log(err)
                })
        },
        getStudentAccount({ commit }, id) {
            return axiosClient
                .get(`/admin-student/${id}`)
                .then((res) => {
                    commit("setCurrentStudent", res.data)
                    return res
                })
        },
        editStudentAccount({ }, student) {
            let response = axiosClient.put(`/admin-student/${student.user_id}`, student)
                .then((res) => {
                    console.log(res)
                    return res;
                });
            // console.log(student.user_id)
            return response;
        },
        deleteStudentAccount({ commit }, id) {
            return axiosClient.delete(`/admin-student/${id}`).then((res) => {
                return res
            })
        },

        saveParentAccount({ commit }, parent) {
            let response = axiosClient.post('/admin-parent', parent)
                .then((res) => {
                    console.log(res)
                    return res;
                });
            return response;
        },

        getParentsAccount({ commit }) {
            commit("setParentLoading", true)
            return axiosClient.get('/admin-parent').then((res) => {
                commit("setParentLoading", false)
                commit("setParentsAccount", res.data)
                console.log(res.data)
                return res
            })
                .catch((err) => {
                    console.log(err)
                })
        },
        getParentAccount({ commit }, id) {
            return axiosClient
                .get(`/admin-parent/${id}`)
                .then((res) => {
                    commit("setCurrentParent", res.data)
                    return res
                })
        },

        editParentAccount({ }, parent) {
            let response = axiosClient.put(`/admin-parent/${parent.user_parent_id}`, parent)
                .then((res) => {
                    console.log(res)
                    return res;
                });
            // console.log(student.user_id)
            return response;
        },

        deleteParentAccount({ commit }, id) {
            return axiosClient.delete(`/admin-parent/${id}`).then((res) => {
                return res
            })
        },

    },
    mutations: {

        setUser: (state, user) => {
            state.user.data = user;
        },
        setTeachersAccount: (state, teachers) => {
            state.teachers.data = teachers
        },
        setStudentsAccount: (state, students) => {
            state.students.data = students
        },
        setParentsAccount: (state, parents) => {
            state.parents.data = parents
        },
        setCurrentTeacher: (state, teacher) => {
            state.currentTeacher.data = teacher
            console.log(state.currentTeacher.data)
        },
        setCurrentStudent: (state, student) => {
            state.currentStudent.data = student
            console.log(state.currentStudent.data)
        },
        setCurrentParent: (state, parent) => {
            state.currentParent.data = parent
            console.log(state.currentParent.data)
        },
        setTeacherLoading: (state, loading) => {
            state.teachers.loading = loading
        },
        setStudentLoading: (state, loading) => {
            state.students.loading = loading
        },
        setParentLoading: (state, loading) => {
            state.parents.loading = loading
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
        notify: (state, { message, type }) => {
            state.notification.show = true;
            state.notification.type = type;
            state.notification.message = message;
            setTimeout(() => {
                state.notification.show = false;
            }, 3000)
        },
    },
    modules: {}
})

export default store