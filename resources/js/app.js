import router from './routes'
import index from './index'
import VueRouter from "vue-router";
import Vue from 'vue';
import Vuex from 'vuex'
import storeDefinition from './store'
require('./bootstrap');

window.Vue = require('vue').default;
Vue.use(VueRouter);
Vue.use(Vuex)

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response.status === 401) {
            store.dispatch('logout');
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
        'index': index
    },
     beforeCreate() {
        this.$store.dispatch('loadUser');
    }
});
