import VueRouter from 'vue-router'
import Calendar from './components/Calendar'
const routes = [
    {
        path: '/',
        name: 'home',
        component: Calendar
    }
]
const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;