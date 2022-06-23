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

import TeacherAssignment from "../views/Teacher/Assignment/AssignmentView.vue"
import TeacherAddAssignment from "../views/Teacher/Assignment/AddAssignment.vue"
import TeacherDetailAssignment from "../views/Teacher/Assignment/DetailAssignment.vue"
import TeacherEditAssignment from "../views/Teacher/Assignment/EditAssignment.vue"
import TeacherAssignmentResult from "../views/Teacher/Assignment/AssignmentResult.vue"

import TeacherDiscuss from "../views/Teacher/Discuss/index.vue"
import TeacherDetailDiscuss from "../views/Teacher/Discuss/DetailDiscuss.vue"
import TeacherAccount from "../views/Teacher/Account/index.vue"

import DashboardStudent from "../views/Student/Dashboard.vue"
import StudentAccount from "../views/Student/Account/index.vue"
import StudentMateris from "../views/Student/Materi/index.vue"
import StudentMateri from "../views/Student/Materi/detailMateri.vue"

import StudentAssignments from "../views/Student/Assignment/AssignmentView.vue"
import StudentAssignment from "../views/Student/Assignment/detailAssignment.vue"

import StudentDiscusses from "../views/Student/Discuss/index.vue"
import StudentDiscuss from "../views/Student/Discuss/DetailDiscuss.vue"

import DashboardParent from "../views/Parent/Dashboard.vue"

import ParentLearnProcess from "../views/Parent/Learn-Process/index.vue"
import ParentAssignmentProcess from "../views/Parent/Assignment/index.vue"


import Login from "../views/Login.vue"
import Register from "../views/Register.vue"
import RegisterOption from "../views/Register-Option.vue"

import DefaultLayout from "../components/DefaultLayout.vue"
import DefaultLayoutTeacher from "../components/DefaultLayoutTeacher.vue"
import DefaultLayoutStudent from "../components/DefaultLayoutStudent.vue"
import DefaultLayoutParent from "../components/DefaultLayoutParent.vue"

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
            { path: '/admin-teacher-account', name: 'AdminTeacherAccount', component: AdminTeacherAccount },
            { path: '/admin/teacher-account/new', name: 'AddTeacherAccount', component: AdminAddTeacherAccount },
            { path: '/admin/teacher-account/edit/:id', name: 'AdminEditTeacherAccount', component: AdminEditTeacherAccount },
            { path: '/admin-student-account', name: 'AdminStudentAccount', component: AdminStudentAccount },
            { path: '/admin/student-account/new', name: 'AddStudentAccount', component: AdminAddStudentAccount },
            { path: '/admin/student-account/edit/:id', name: 'AdminEditStudentAccount', component: AdminEditStudentAccount },
            { path: '/admin-parent-account', name: 'ParentAccount', component: AdminParentAccount },
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
            { path: 'teacher/materi/edit/:id', name: 'TeacherEditMateri', component: TeacherEditMateri },
            { path: '/teacher/assignment', name: 'TeacherAssignment', component: TeacherAssignment },
            { path: '/teacher/assignment/new', name: 'AddTeacherAssignment', component: TeacherAddAssignment },
            { path: 'teacher/assignment/detail/:id/:slug', name: 'TeacherDetailAssignment', component: TeacherDetailAssignment },
            { path: 'teacher/assignment/edit/:id', name: 'TeacherEditAssignment', component: TeacherEditAssignment },
            { path: 'teacher/assignment/result/:id', name: 'TeacherAssignmentResult', component: TeacherAssignmentResult },
            { path: '/teacher/discuss', name: 'TeacherDiscuss', component: TeacherDiscuss },
            { path: '/teacher/discuss/detail/:id', name: 'TeacherDetailDiscuss', component: TeacherDetailDiscuss },
            { path: '/teacher-account', name: 'TeacherAccount', component: TeacherAccount },
        ]
    },
    {
        path: '/',
        name: 'DashboardStudent',
        redirect: '/dashboard-student',
        component: DefaultLayoutStudent,
        meta: { requiresAuth: true },
        beforeEnter: (to, from, next) => {
            // reject the navigation
            if (store.state.user.role != 'student') {
                console.log('gagal')
            } else {
                next()
            }
        },
        children: [
            { path: '/dashboard-student', name: 'DashboardStudent', component: DashboardStudent },
            { path: '/student-account', name: 'StudentAccount', component: StudentAccount },
            { path: '/student-materi', name: 'StudentMateri', component: StudentMateris },
            { path: '/student-materi/:id', name: 'StudentGetMateri', component: StudentMateri },
            { path: '/student-assignment', name: 'StudentAssignments', component: StudentAssignments },
            { path: '/student-assignment/:id', name: 'StudentGetAssignment', component: StudentAssignment },
            { path: '/student-discuss', name: 'StudentDiscusses', component: StudentDiscusses },
            { path: '/student-discuss/:id', name: 'StudentDetailDiscuss', component: StudentDiscuss },
        ]
    },
    {
        path: '/',
        name: 'DashboardParent',
        redirect: '/dashboard-parent',
        component: DefaultLayoutParent,
        meta: { requiresAuth: true },
        beforeEnter: (to, from, next) => {
            // reject the navigation
            if (store.state.user.role != 'parent') {
                console.log('gagal')
            } else {
                next()
            }
        },
        children: [
            { path: '/dashboard-parent', name: 'DashboardParent', component: DashboardParent },
            { path: '/parent-learn-process', name: 'ParentLearnProcess', component: ParentLearnProcess },
            { path: '/parent-assignment-process', name: 'ParentAssignmentProcess', component: ParentAssignmentProcess },
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
                component: RegisterOption
            },
            {
                path: '/register-account/:role',
                name: 'RegisterAccount',
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
        if (store.state.user.role === 'student') {
            next({ name: "DashboardStudent" });
        }
        if (store.state.user.role === 'parent') {
            next({ name: "DashboardParent" });
        }
        else {
            next()
        }
    } else {
        next();
    }
})

export default router