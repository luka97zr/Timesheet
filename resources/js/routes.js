import VueRouter from 'vue-router'
import Calendar from './calendar/Calendar'
import EditDay from './day/EditDay'
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
    }
]
const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;