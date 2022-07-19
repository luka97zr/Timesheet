import router from './routes'
import index from './index'
import VueRouter from "vue-router";
import Vue from 'vue';
import Vuex from 'vuex'
import storeDefinition from './store'
import  Modal  from './components/Modal/Modal';
import Vuetify from 'vuetify';

require('./bootstrap');

Vue.component('Modal',Modal)

window.Vue = require('vue').default;
Vue.use(VueRouter);
Vue.use(Vuetify); 
Vue.use(Vuex)

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response.status === 401 && router.currentRoute.path !== '/auth/login' && !store.state.gotToken) {
            router.push({name : 'login'})
            localStorage.removeItem('jwt');
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
    vuetify: new Vuetify(),
    beforeCreate() {
        store.dispatch('loadUser')
    }
});
