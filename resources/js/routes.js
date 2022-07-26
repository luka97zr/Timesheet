import VueRouter from 'vue-router'
import Calendar from './pages/timesheet/calendar/Calendar'
import EditDay from './pages/timesheet/day/EditDay'
import Login from './pages/auth/Login'
import Clients from './pages/clients/Clients'
import Projects from './pages/projects/Projects'
import Categories from './pages/categories/Categories'
import Employees from './pages/employees/Employees'
import Reports from './pages/reports/Reports'
import NotFound from './pages/404/NotFound'
const routes = [
    {
        path: '/',
        name: 'home',
        component: Calendar,

    },
    {
        path: '/date/:day',
        name: 'dayEdit',
        component: EditDay,
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

    },
    {
        path: '/projects',
        name: 'projects',
        component: Projects,
    },
    {
        path: '/categories',
        name: 'categories',
        component: Categories,
    },
    {
        path: '/employees',
        name: 'employees',
        component: Employees,
    },
    {
        path: '/reports',
        name: 'reports',
        component: Reports,
    },
    {
        path: '*',
        component: NotFound,
        meta: {
            hideNavbar: true
        }   
    }

]
const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;