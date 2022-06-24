import VueRouter from 'vue-router'
import Calendar from './calendar/Calendar'
import EditDay from './day/EditDay'
import Login from './auth/Login'
import Clients from './clients/Clients'
import Projects from './projects/Projects'
import Categories from './categories/Categories'
import Employees from './employees/Employees'
import Reports from './reports/Reports'
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
        }
    },
    {
        path: '/projects',
        name: 'projects',
        component: Projects,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/categories',
        name: 'categories',
        component: Categories,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/employees',
        name: 'employees',
        component: Employees,
        meta: {
            requiresAuth: true,
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