import router from './routes'
import index from './index'
import VueRouter from "vue-router";
import axios from 'axios';
require('./bootstrap');

window.Vue = require('vue').default;
Vue.use(VueRouter);



const app = new Vue({
    el: "#app",
    router,
    components: {
        'index': index
    },
    async beforeCreate() {
        
    }
});
