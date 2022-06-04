import { createRouter, createWebHistory } from "vue-router"

import DashboardAdmin from "../views/Admin/Dashboard.vue"
import AdminTeacherAccount from "../views/Admin/Teacher-Account/index.vue"
import AdminAddTeacherAccount from "../views/Admin/Teacher-Account/AddTeacher.vue"
import AdminEditTeacherAccount from "../views/Admin/Teacher-Account/EditTeacher.vue"

import AdminStudentAccount from "../views/Admin/Student-Account/index.vue"
import AdminAddStudentAccount from "../views/Admin/Student-Account/AddStudent.vue"
import AdminEditStudentAccount from "../views/Admin/Student-Account/EditStudent.vue"

import AdminParentAccount from "../views/Admin/Parent-Account/index.vue"
import AdminAddParentAccount from "../views/Admin/Parent-Account/AddParent.vue"
import AdminEditParentAccount from "../views/Admin/Parent-Account/EditParent.vue"


import DashboardTeacher from "../views/Teacher/Dashboard.vue"
import TeacherMateri from "../views/Teacher/Materi/index.vue"
import TeacherAddMateri from "../views/Teacher/Materi/AddMateri.vue"
import TeacherEditMateri from "../views/Teacher/Materi/EditMateri.vue"

import TeacherAssignment from "../views/Teacher/Assignment/index.vue"
import TeacherAddAssignment from "../views/Teacher/Assignment/AddAssignment.vue"
import TeacherEditAssignment from "../views/Teacher/Assignment/EditAssignment.vue"

import TeacherDiscuss from "../views/Teacher/Discuss/index.vue"
import TeacherDetailDiscuss from "../views/Teacher/Discuss/DetailDiscuss.vue"

import Login from "../views/Login.vue"
import Register from "../views/Register.vue"

import DefaultLayout from "../components/DefaultLayout.vue"
import DefaultLayoutTeacher from "../components/DefaultLayoutTeacher.vue"
import AuthLayout from "../components/AuthLayout.vue"

import store from "../store"

const routes = [
    {
        path: '/',
        name: 'Dashboard',
        redirect: '/dashboard-admin',
        component: DefaultLayout,
        meta: { requiresAuth: true },
        beforeEnter: (to, from, next) => {
            // reject the navigation
            if (store.state.user.role != 'admin') {
                console.log('gagal')
            } else {
                next()
            }
        },
        children: [
            { path: '/dashboard-admin', name: 'Dashboard', component: DashboardAdmin },
            { path: '/admin/teacher-account', name: 'TeacherAccount', component: AdminTeacherAccount },
            { path: '/admin/teacher-account/new', name: 'AddTeacherAccount', component: AdminAddTeacherAccount },
            { path: '/admin/teacher-account/edit/:id', name: 'AdminEditTeacherAccount', component: AdminEditTeacherAccount },
            { path: '/admin/student-account', name: 'StudentAccount', component: AdminStudentAccount },
            { path: '/admin/student-account/new', name: 'AddStudentAccount', component: AdminAddStudentAccount },
            { path: '/admin/student-account/edit/:id', name: 'AdminEditStudentAccount', component: AdminEditStudentAccount },
            { path: '/admin/parent-account', name: 'ParentAccount', component: AdminParentAccount },
            { path: '/admin/parent-account/new', name: 'AddParentAccount', component: AdminAddParentAccount },
            { path: '/admin/parent-account/edit/:id', name: 'AdminEditParentAccount', component: AdminEditParentAccount },
        ]
    },
    {
        path: '/',
        name: 'DashboardTeacher',
        redirect: '/dashboard-teacher',
        component: DefaultLayoutTeacher,
        meta: { requiresAuth: true },
        beforeEnter: (to, from, next) => {
            // reject the navigation
            if (store.state.user.role != 'teacher') {
                console.log('gagal')
            } else {
                next()
            }
        },
        children: [
            { path: '/dashboard-teacher', name: 'DashboardTeacher', component: DashboardTeacher },
            { path: '/teacher/materi', name: 'TeacherMateri', component: TeacherMateri },
            { path: '/teacher/materi/new', name: 'AddTeacherMateri', component: TeacherAddMateri },
            { path: '/admin/teacher-materi/edit/:id', name: 'TeacherEditMateri', component: TeacherEditMateri },
            { path: '/teacher/assignment', name: 'TeacherAssignment', component: TeacherAssignment },
            { path: '/teacher/assignment/new', name: 'AddTeacherAssignment', component: TeacherAddAssignment },
            { path: '/admin/teacher-assignment/edit/:id', name: 'TeacherEditAssignment', component: TeacherEditAssignment },
            { path: '/teacher/discuss', name: 'TeacherDiscuss', component: TeacherDiscuss },
            { path: '/teacher/discuss/detail/:id', name: 'TeacherDetailDiscuss', component: TeacherDetailDiscuss },
        ]
    },
    {
        path: '/auth',
        redirect: '/login',
        name: 'Auth',
        component: AuthLayout,
        meta: { isGuest: true },
        children: [
            {
                path: '/register',
                name: 'Register',
                component: Register
            },
            {
                path: '/login',
                name: 'Login',
                component: Login
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({ name: 'Login' })
    } else if (store.state.user.token && to.meta.isGuest) {
        if (store.state.user.role === 'admin') {
            next({ name: "Dashboard" });
        }
        if (store.state.user.role === 'teacher') {
            next({ name: "DashboardTeacher" });
        }
        else {
            next()
        }
    } else {
        next();
    }
})

export default router