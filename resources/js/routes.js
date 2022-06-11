import VueRouter from 'vue-router'
import Calendar from './calendar/Calendar'
import EditDay from './day/EditDay'
import Login from './auth/Login'
const routes = [
    {
        path: '/',
        name: 'home',
        component: Calendar
    },
    {
        path: '/date/:day',
        name: 'dayEdit',
        component: EditDay
    },
    {
        path: '/auth/login',
        name: 'login',
        component: Login
    }
]
const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;