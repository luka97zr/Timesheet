import router from './routes'
import index from './index'
import VueRouter from "vue-router";
import Vue from 'vue';
import Vuex from 'vuex'
import storeDefinition from './store'
import  Modal  from './components/Modal/Modal';
import ModalDelete from './components/ModalDelete/ModalDelete'
import Vuetify from 'vuetify';
import VuetifyContainer from './components/vuetify/VuetifyContainer'
import InputError from './components/Bootstrap/InputError'


require('./bootstrap');

Vue.component('vuetify-container',VuetifyContainer)
Vue.component('Modal',Modal)
Vue.component('ModalDelete',ModalDelete)
Vue.component('InputError',InputError)

window.Vue = require('vue').default;
Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.use(Vuex)

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response.status === 401 && router.currentRoute.path !== '/auth/login') {
            localStorage.removeItem('user');
            router.push('/auth/login');
        }
        if (error.response.status === 403) {
            router.push('*');
        }
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
        if (localStorage.getItem('user'))
        store.commit('setLoggedIn', true)
    }
});
