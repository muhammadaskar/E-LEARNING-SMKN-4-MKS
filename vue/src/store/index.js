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
        materis: {
            data: {},
            loading: false
        },
        assignments: {
            data: {},
            loading: false
        },
        student_assignments: {
            data: {},
            loading: false
        },
        learn_process: {
            data: {},
            dataSudah: {},
            loading: false
        },
        student_assignment: {
            data: {},
            loading: false
        },
        discusses: {
            data: {},
            loading: false
        },
        comments: {
            data: {},
            loading: false
        },
        currentTeacher: {
            data: {},
            loading: false
        },
        currentStudent: {
            data: {},
            loading: false,
            user_id: ""
        },
        currentParent: {
            data: {},
            loading: false
        },
        currentMateri: {
            data: {},
            status_pengerjaan: {},
            loading: false
        },
        currentAssignment: {
            data: {},
            loading: false
        },
        currentDiscuss: {
            data: {},
            loading: false
        },
        currentComment: {
            data: {},
            loading: false,
            length: 0
        },
        currentStatusMateri: {
            data: {}
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

        saveTeacherMateri({ commit }, materi) {
            let response = axiosClient.post('/teacher-materi', materi, {
                'content-type': "multipart/form-data;"
            })
                .then((res) => {
                    console.log(res)
                    return res;
                });
            return response;
        },
        getTeacherMateris({ commit }) {
            commit("setMateriLoading", true)
            return axiosClient.get('/teacher-materi').then((res) => {
                commit("setMateriLoading", false)
                commit("setTeacherMateris", res.data)
                console.log(res.data)
                return res
            })
                .catch((err) => {
                    console.log(err)
                })
        },
        getTeacherMateri({ commit }, id) {
            return axiosClient
                .get(`/teacher-materi/${id}`)
                .then((res) => {
                    commit("setCurrentMateri", res.data)
                    return res
                })
        },
        editTeacherMateri({ }, materi) {
            id = materi.get("id");
            let response = axiosClient.put(`/teacher-materi/${id}`, materi, {
                'content-type': "multipart/form-data;"
            })
                .then((res) => {
                    console.log(res)
                    return res;
                });
            return response;
        },
        deleteMateri({ commit }, id) {
            return axiosClient.delete(`/teacher-materi/${id}`).then((res) => {
                return res
            })
        },

        saveTeacherAssignment({ commit }, assignment) {
            let response = axiosClient.post('/teacher-assignment', assignment)
                .then((res) => {
                    console.log(res)
                    return res;
                })
            return response;
        },
        getTeacherAssignments({ commit }) {
            commit("setAssignmentLoading", true)
            return axiosClient.get('/teacher-assignment').then((res) => {
                commit("setAssignmentLoading", false)
                commit("setTeacherAsignments", res.data)
                console.log(res.data)
                return res
            })
                .catch((err) => {
                    console.log(err)
                })
        },
        detailTeacherAssignment({ commit }, id) {
            this.state.student_assignments.loading = true
            return axiosClient
                .get(`/teacher-assignment/${id}`)
                .then((res) => {
                    this.state.student_assignments.loading = false
                    commit("setCurrentAssignment", res.data.assignment)
                    this.state.student_assignments.data = res.data.student_assignments
                    console.log(res.data.student_assignments)
                    // console.log(this.state.student_assignments.data)
                    return res
                }).catch((err) => {
                    this.state.student_assignments.loading = false
                })
        },
        getTeacherAssignment({ commit }, id) {
            return axiosClient
                .get(`/teacher-assignment/${id}`)
                .then((res) => {
                    commit("setCurrentAssignment", res.data.assignment)
                    return res
                })
        },
        editTeacherAssignment({ }, assignment) {
            let response = axiosClient.put(`/teacher-assignment/${assignment.id}`, assignment)
                .then((res) => {
                    console.log(res)
                    return res;
                });
            return response;
        },
        deleteAssignment({ commit }, id) {
            return axiosClient.delete(`/teacher-assignment/${id}`).then((res) => {
                return res
            })
        },
        teacherAssignmentResult({ commit }, id) {
            this.state.student_assignments.loading = true
            return axiosClient
                .get(`/teacher-assignment-result/${id}`)
                .then((res) => {
                    this.state.student_assignments.loading = false
                    commit("setCurrentAssignment", res.data)
                    return res
                }).catch((err) => {
                    this.state.student_assignments.loading = false
                })
        },
        saveStudentScore({ }, assignment) {
            let response = axiosClient.put(`/teacher-student-score/${assignment.id}`, assignment)
                .then((res) => {
                    console.log(res)
                    return res;
                });
            return response;
        },
        deleteScore({ commit }, id) {
            return axiosClient.delete(`/teacher-student-score/${id}`).then((res) => {
                return res
            })
        },
        saveTeacherDiscuss({ commit }, discuss) {
            let response = axiosClient.post('/teacher-discuss', discuss)
                .then((res) => {
                    console.log(res)
                    return res;
                })
            return response;
        },
        getTeacherDiscusses({ commit }) {
            commit("setDiscussLoading", true)
            return axiosClient.get('/teacher-discuss').then((res) => {
                commit("setDiscussLoading", false)
                commit("setTeacherDiscusses", res.data)
                console.log(res.data)
                return res
            })
                .catch((err) => {
                    console.log(err)
                })
        },
        getTeacherDiscuss({ commit }, id) {
            commit("setCurrentDiscussLoading", true)
            commit("setCommentLoading", true)
            return axiosClient
                .get(`/teacher-discuss/${id}`)
                .then((res) => {
                    commit("setCurrentDiscussLoading", false)
                    commit("setCommentLoading", false)
                    commit("setCurrentDiscuss", res.data.discuss)
                    commit("setCurrentComment", res.data.comments)
                    this.state.currentComment.length = res.data.comments.length
                    return res
                })
        },
        editTeacherDiscuss({ }, discuss) {
            console.log(discuss.id)
            let response = axiosClient.put(`/teacher-discuss/${discuss.id}`, discuss)
                .then((res) => {
                    console.log(res)
                    return res;
                });
            return response;
        },
        deleteDiscuss({ commit }, id) {
            return axiosClient.delete(`/teacher-discuss/${id}`).then((res) => {
                return res
            })
        },
        saveTeacherComment({ commit }, comment) {
            let response = axiosClient.post('/teacher-comment', comment)
                .then((res) => {
                    console.log(res)
                    return res;
                })
            return response;
        },
        deleteComment({ commit }, id) {
            return axiosClient.delete(`/teacher-comment/${id}`).then((res) => {
                return res
            })
        },
        getStudentMateris({ commit }) {
            commit("setMateriLoading", true)
            return axiosClient.get('/student-materi').then((res) => {
                commit("setMateriLoading", false)
                commit("setStudentMateris", res.data)
                console.log(res.data)
                return res
            })
                .catch((err) => {
                    console.log(err)
                })
        },
        getStudentMateri({ commit }, id) {
            commit("setCurrentMateriLoading", true)
            return axiosClient
                .get(`/student-materi/${id}`)
                .then((res) => {
                    commit("setCurrentMateriLoading", false)
                    commit("setCurrentMateri", res.data)
                    return res
                })
        },
        sendEvalutionQuestion({ commit }, answer) {
            let response = axiosClient.post('/student-evaluation-answer', answer)
                .then((res) => {
                    console.log(res)
                    return res;
                });
            return response;
        },

        getStudentAssignments({ commit }, id) {
            commit("setAssignmentLoading", true)
            return axiosClient.get('/student-assignment').then((res) => {
                commit("setAssignmentLoading", false)
                commit("setStudentAsignments", res.data)
                return res
            })
                .catch((err) => {
                    console.log(err)
                })
        },
        getStudentAssignment({ commit }, id) {
            commit("setCurrentAssignmentLoading", true)
            return axiosClient.get(`/student-assignment/${id}`).then((res) => {
                commit("setCurrentAssignmentLoading", false)
                commit("setCurrentAssignment", res.data)
                console.log(res.data)
                return res
            })
                .catch((err) => {
                    console.log(err)
                })
        },
        sendStudentAssignment({ commit }, assignment) {
            let response = axiosClient.post('/student-assignment', assignment)
                .then((res) => {
                    console.log(res)
                    return res;
                })
            return response;
        },
        getStudentDiscusses({ commit }) {
            commit("setDiscussLoading", true)
            return axiosClient.get('/student-discuss').then((res) => {
                commit("setDiscussLoading", false)
                commit("setStudentDiscusses", res.data)
                console.log(res.data)
                return res
            })
                .catch((err) => {
                    console.log(err)
                })
        },
        getStudentDiscuss({ commit }, id) {
            commit("setCurrentDiscussLoading", true)
            commit("setCommentLoading", true)
            return axiosClient
                .get(`/student-discuss/${id}`)
                .then((res) => {
                    commit("setCurrentDiscussLoading", false)
                    commit("setCommentLoading", false)
                    commit("setCurrentDiscuss", res.data.discuss)
                    commit("setCurrentComment", res.data.comments)
                    // commit("setCurrentStudent", res.data.student)
                    this.state.currentStudent.user_id = res.data.student_user_id
                    this.state.currentComment.length = res.data.comments.length
                    return res
                })
        },
        saveStudentComment({ commit }, comment) {
            let response = axiosClient.post('/student-discuss', comment)
                .then((res) => {
                    console.log(res)
                    return res;
                })
            return response;
        },
        studentDeleteComment({ commit }, id) {
            return axiosClient.delete(`/student-discuss/${id}`).then((res) => {
                return res
            })
        },
        studentGetAccount({ commit }) {
            commit("setStudentLoading", true)
            return axiosClient.get('/student-account').then((res) => {
                commit("setStudentLoading", false)
                commit("setCurrentStudent", res.data)
                return res
            })
                .catch((err) => {
                    console.log(err)
                })
        },
        studentEditAccount({ commit }, student) {
            let response = axiosClient.put('/student-account', student)
                .then((res) => {
                    console.log(res)
                    return res;
                });
            return response;
        },
        getLearnProcess({ commit }) {
            commit("setLearnProcessLoading", true)
            return axiosClient.get('/parent-learn-process').then((res) => {
                commit("setLearnProcessLoading", false)
                commit("setLearnProcess", res.data)
                return res
            })
                .catch((err) => {
                    commit("setLearnProcessLoading", false)
                    console.log(err)
                })
        },
        getAssignmentProcess({ commit }) {
            commit("setAssignmentLoading", true)
            return axiosClient.get('/parent-assignment-process').then((res) => {
                commit("setAssignmentLoading", false)
                commit("setParentAsignments", res.data)
                return res
            })
                .catch((err) => {
                    console.log(err)
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
        setTeacherMateris: (state, materis) => {
            state.materis.data = materis
        },
        setTeacherAsignments: (state, assignments) => {
            state.assignments.data = assignments
        },
        setParentAsignments: (state, assignments) => {
            state.assignments.data = assignments
        },
        setStudentAsignments: (state, assignments) => {
            state.assignments.data = assignments
        },
        setTeacherDiscusses: (state, discusses) => {
            state.discusses.data = discusses
        },
        setStudentDiscusses: (state, discusses) => {
            state.discusses.data = discusses
        },
        setStudentMateris: (state, materis) => {
            state.materis.data = materis
        },
        setLearnProcess: (state, learn_process) => {
            state.learn_process.data = learn_process
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
        setCurrentMateri: (state, materi) => {
            state.currentMateri.data = materi
            // console.log(state.currentMateri.data)
        },
        setCurrentMateriStatus: (state, materi) => {
            state.currentStatusMateri.data = materi
            console.log(state.currentStatusMateri.data)
        },
        setCurrentAssignment: (state, assignment) => {
            state.currentAssignment.data = assignment
            console.log(state.currentAssignment.data)
        },
        setCurrentDiscuss: (state, discuss) => {
            state.currentDiscuss.data = discuss
            console.log(state.currentDiscuss.data)
        },
        setCurrentComment: (state, comment) => {
            state.currentComment.data = comment
            console.log(state.currentComment.data)
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
        setMateriLoading: (state, loading) => {
            state.materis.loading = loading
        },
        setAssignmentLoading: (state, loading) => {
            state.assignments.loading = loading
        },
        setDiscussLoading: (state, loading) => {
            state.discusses.loading = loading
        },
        setCommentLoading: (state, loading) => {
            state.currentComment.loading = loading
        },
        setLearnProcessLoading: (state, loading) => {
            state.learn_process.loading = loading
        },
        setCurrentDiscussLoading: (state, loading) => {
            state.currentDiscuss.loading = loading
        },
        setCurrentMateriLoading: (state, loading) => {
            state.currentMateri.loading = loading
        },
        setCurrentAssignmentLoading: (state, loading) => {
            state.currentAssignment.loading = loading
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