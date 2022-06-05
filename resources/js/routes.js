import VueRouter from 'vue-router'
import Calendar from './calendar/Calendar'
import Day from './day/Day'
const routes = [
    {
        path: '/',
        name: 'home',
        component: Calendar
    },
    {
        path: '/date/:day',
        name: 'day',
        component: Day
    }
]
const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;