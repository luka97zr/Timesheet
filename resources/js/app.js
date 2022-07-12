import router from './routes'
import index from './index'
import VueRouter from "vue-router";
import Vue from 'vue';
import Vuex from 'vuex'
import storeDefinition from './store'
import  Modal  from './components/Modal/Modal';
require('./bootstrap');

Vue.component('Modal',Modal)

window.Vue = require('vue').default;
Vue.use(VueRouter);
Vue.use(Vuex)

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response.status === 401 && !this.$route.path !== '/auth/login') {
            router.push({name : 'login'})
            // store.dispatch('logout');

        }
        return Promise.reject(error)
    }
    )

const store = new Vuex.Store(storeDefinition);


const app = new Vue({
    el: "#app",
    router,
    store,
    components: {
        'index': index,
    },
     beforeCreate() {
        // this.$store.dispatch('loadUser')
        if (!this.$store.getters.isUserAuth && !this.$route.path !== '/auth/login') router.push({name : 'login'}).catch(err => {
            console.log(err)
        })
    }
});
