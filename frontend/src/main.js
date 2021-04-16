require('./bootstrap');
// require('./plugins/index');

import Vue from 'vue';
import BaseTemplate from './layouts/BaseTemplate';
import router from './router';
import store from './store';

Vue.config.productionTip = false;

/** Global Components */
Vue.component('preloader-component', () => import('./components/Preloader'));

new Vue({
  router,
  store,
  render: h => h(BaseTemplate)
}).$mount('#app');
