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
