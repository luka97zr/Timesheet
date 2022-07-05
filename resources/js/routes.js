import VueRouter from 'vue-router'
import Calendar from './pages/timesheet/calendar/Calendar'
import EditDay from './pages/timesheet/day/EditDay'
import Login from './pages/auth/Login'
import Clients from './pages/clients/Clients'
import Projects from './pages/projects/Projects'
import Categories from './pages/categories/Categories'
import Employees from './pages/employees/Employees'
import Reports from './pages/reports/Reports'
const routes = [
    {
        path: '/',
        name: 'home',
        component: Calendar,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/date/:day',
        name: 'dayEdit',
        component: EditDay,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/auth/login',
        name: 'login',
        component: Login,
        meta: {
            hideNavbar: true
        }
    },
    {
        path: '/clients',
        name: 'clients',
        component: Clients,
        meta: {
            requiresAuth: true,
            modal: true,
            modalName: 'client'
        }
    },
    {
        path: '/projects',
        name: 'projects',
        component: Projects,
        meta: {
            requiresAuth: true,
            modal: true,
            modalName: 'project'
        }
    },
    {
        path: '/categories',
        name: 'categories',
        component: Categories,
        meta: {
            requiresAuth: true,
            modal: true,
            modalName: 'category'
        }
    },
    {
        path: '/employees',
        name: 'employees',
        component: Employees,
        meta: {
            requiresAuth: true,
            modal: true,
            modalName: 'empolyee'

        }
    },
    {
        path: '/reports',
        name: 'reports',
        component: Reports,
        meta: {
            requiresAuth: true,
        }
    },


]
const router = new VueRouter({
    routes,
    mode: 'history'
});


router.beforeEach((to,from,next)=>{
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if(localStorage.getItem('isLoggedIn') === 'false') {
            next({name: 'login'})
        } else {
            next();
        }
    } else {
        next()
    }
})


export default router;