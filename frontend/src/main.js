require('./bootstrap');
// require('./plugins/index');

import Vue from 'vue';
import App from './App';
import router from './router';
import store from './store';
import VueToastify from 'vue-toastify';
import VueMask from 'v-mask';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import './configs/vee-validate';


Vue.config.productionTip = false;
Vue.use(VueToastify);
Vue.use(VueMask);
Vue.use(VueSweetalert2);

/** Global Components */
Vue.component('preloader-component', () => import('./components/Preloader'));

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app');
