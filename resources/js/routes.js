import store from './store'
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
        meta: {
          requiresAuth: true
        }
    },
    {
        path: '/date/:day',
        name: 'dayEdit',
        component: EditDay,
        meta: {
          requiresAuth: true
        }
    },
    {
        path: '/auth/login',
        name: 'login',
        component: Login,
        meta: {
            hideNavbar: true,
        }
    },
    {
        path: '/clients',
        name: 'clients',
        component: Clients,
        meta: {
            adminRequired: true,
            requiresAuth: true
        }
    },
    {
        path: '/projects',
        name: 'projects',
        component: Projects,
        meta: {
            adminRequired: true,
            requiresAuth: true
        }
    },
    {
        path: '/categories',
        name: 'categories',
        component: Categories,
        meta: {
            adminRequired: true,
            requiresAuth: true
        }
    },
    {
        path: '/employees',
        name: 'employees',
        component: Employees,
        meta: {
            adminRequired: true,
            requiresAuth: true
        }
    },
    {
      path: '/reports',
      name: 'reports',
      component: Reports,
      meta: {
        requiresAuth: true
      }
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
    mode: 'history',
    linkExactActiveClass: "navigation__button--active"
});

router.beforeEach(async (to, from, next) => {
    if(to.matched.some(record => record.meta.adminRequired)) {
      if (store.getters.isUserAuth && JSON.parse(localStorage.getItem('user')).role === 'Admin') {
        next();
      } else {
        next('*');
      }
    } else {
      next();
    }

    if(to.matched.some(record => record.meta.requiresAuth)) {
        function doesHttpOnlyCookieExist(cookiename) {
          const date = new Date();
          date.setTime(date.getTime() + (1000));
          const expires = "expires=" + date.toUTCString();
          document.cookie = cookiename + "=new_value;path=/;" + expires;
          return document.cookie.indexOf(cookiename + '=') == -1;
        }
      if (doesHttpOnlyCookieExist('token') && to.path !== '/auth/login') {
        next();
      } else {
        next({name:'login'});
      }
    }
  })


export default router;