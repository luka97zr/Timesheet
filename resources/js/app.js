import router from './routes'
import index from './index'
import VueRouter from "vue-router";
import Vue from 'vue';
import Vuex from 'vuex'
import storeDefinition from './store'
import  Modal  from './components/Modal/Modal';
import Vuetify from 'vuetify';
import VuetifyContainer from './components/vuetify/VuetifyContainer'


require('./bootstrap');

Vue.component('vuetify-container',VuetifyContainer)
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
        // if (error.response.status === 401 && router.currentRoute.path !== '/auth/login') {
        //     localStorage.removeItem('jwt');
        //     router.push({name : 'login'})
        //     store.dispatch('logout');
        // }
        return Promise.reject(error)
    }
    )

const store = new Vuex.Store(storeDefinition);

export default new Vuetify({
    theme: { light: true },
  })

const app = new Vue({
    el: "#app",
    router,
    store,
    vuetify: new Vuetify(),
    components: {
        'index': index,
    },
    beforeCreate() {
        if (localStorage.getItem('jwt'))
        store.dispatch('loadUser')
    }
});
