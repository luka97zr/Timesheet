import VueRouter from 'vue-router'
import CalendarView from './components/CalendarView'
const routes = [
    {
        path: '/',
        name: 'home',
        component: CalendarView
    }
]
const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;