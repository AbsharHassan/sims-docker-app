import { createRouter, createWebHistory } from 'vue-router';
import store from '../store/modules/StudentEntries'

import Home from '../views/Home.vue'
import GetPassword from '../views/GetPassword.vue'
import someShit from '../views/EntryViews/someShit.vue'
import ListUsers from '../views/EntryViews/ListUsers.vue'
import Dashboard from '../views/Dashboard.vue'
import PasswordRecovery from '../views/PasswordRecovery.vue'
import Register from '../views/Register.vue'
import Login from '../views/Login.vue'
import CreateEntry from '../views/CreateForms/CreateEntry.vue'
import FamilyDataEntry from '../views/CreateForms/FamilyDataEntry.vue'
import AcademicsDataEntry from '../views/CreateForms/AcademicsDataEntry.vue'
import StudentEntry from '../views/EntryViews/StudentEntry.vue'
import CreateCourse from '../views/CreateForms/CreateCourse.vue'
import AllCourseEntries from '../views/EntryViews/AllCourseEntries.vue'
import SingleCourse from '../views/EntryViews/SingleCourse.vue'
import EditCourse from '../views/EditForms/EditCourse.vue'
import EditStudent from '../views/EditForms/EditStudent.vue'
import EditStudentFamily from '../views/EditForms/EditStudentFamily.vue'
import EditStudentAcademics from '../views/EditForms/EditStudentAcademics.vue'


const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/list-users',
        name: 'ListUsers',
        component: ListUsers
    },
    {
        path: '/forgot-password',
        name: 'GetPassword',
        component: GetPassword
    },
    {
        path: '/someshit',
        name: 'SomeShit',
        component: someShit
    },
    {
        path: '/students',
        name: 'Dashboard',
        component: Dashboard
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        beforeEnter: (to, from) => {
            if(from.name === 'Register') {
                to.meta.transitionName = 'LoginRegister'
            } else {
                to.meta.transitionName = 'slideUp'
            }
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        beforeEnter: (to, from, next) => {
            if(from.name === 'Login') {
                to.meta.transitionName = 'LoginRegister'
                next()
            } else {
                to.meta.transitionName = 'slideUp'
                next()
            }
        }
    },
    {
        path: '/students/create',
        name: 'CreateEntry',
        component: CreateEntry,
    },
    {
        path: '/students/:student_id/family/create',
        name: 'FamilyDataEntry',
        component: FamilyDataEntry,
    },
    {
        path: '/students/:student_id/academics/create',
        name: 'AcademicsDataEntry',
        component: AcademicsDataEntry
    },
    {
        path: '/students/:student_id',
        name: 'StudentEntry',
        component: StudentEntry
    },
    {
        path: '/students/:student_id/edit',
        name: 'EditStudent',
        component: EditStudent
    },
    {
        path: '/students/:student_id/family/edit',
        name: 'EditStudentFamily',
        component: EditStudentFamily
    },
    {
        path: '/students/:student_id/academics/edit',
        name: 'EditStudentAcademics',
        component: EditStudentAcademics
    },
    {
        path: '/courses/create',
        name: 'CreateCourse',
        component: CreateCourse
    },
    {
        path: '/courses',
        name: 'AllCourseEntries',
        component: AllCourseEntries
    },
    {
        path: '/courses/:course_id',
        name: 'SingleCourse',
        component: SingleCourse
    },
    {
        path: '/courses/:course_id/edit',
        name: 'EditCourse',
        component: EditCourse
    },
    {
        path: '/password-recovery',
        name: 'PasswordRecovery',
        component: PasswordRecovery
    }
]

const router = createRouter({
    history: createWebHistory(process.env.APP_URL),
    routes
})

router.beforeEach((to, from, next) => {
    if(((to.name === 'Login') || (to.name === 'Register') || (to.name === 'GetPassword')) && (!store.state.authToken)) {
        next()
    } else if(((to.name === 'Login') || (to.name === 'Register') || (to.name === 'GetPassword')) && (store.state.authToken)) {
        next({path: `${sessionStorage.getItem('PREVIOUS-ROUTE-NAME')}`})
        // next({name: 'Dashboard'})
    } else if((to.name !== 'Login' && to.name !== 'Register' && to.name !== 'GetPassword' && store.state.authToken)) {
        next()
    }
  })

router.afterEach((to, from) => {
    sessionStorage.setItem('PREVIOUS-ROUTE-NAME', to.path)
})

export default router;