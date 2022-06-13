import VueRouter from 'vue-router'
import Calendar from './calendar/Calendar'
import EditDay from './day/EditDay'
import Login from './auth/Login'
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
    }
]
const router = new VueRouter({
    routes,
    mode: 'history'
});


router.beforeEach((to,from,next)=>{
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if(!localStorage.getItem('isLoggedIn')) {
            next({name: 'login'})
        } else {
            next();
        }
    } else {
        next()
    }
})


export default router;