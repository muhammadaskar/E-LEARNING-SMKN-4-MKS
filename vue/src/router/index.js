import { createRouter, createWebHistory } from "vue-router"

import DashboardAdmin from "../views/Admin/Dashboard.vue"
import AdminTeacherAccount from "../views/Admin/Teacher-Account/index.vue"
import AdminAddTeacherAccount from "../views/Admin/Teacher-Account/AddTeacher.vue"

import Login from "../views/Login.vue"
import Register from "../views/Register.vue"

import DefaultLayout from "../components/DefaultLayout.vue"
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
        } else {
            next()
        }
    } else {
        next();
    }
})

export default router