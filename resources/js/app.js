import router from './routes'
import index from './index'
import VueRouter from "vue-router";
require('./bootstrap');

window.Vue = require('vue').default;
Vue.use(VueRouter);



const app = new Vue({
    el: "#app",
    router,
    components: {
        'index': index
    }
});
