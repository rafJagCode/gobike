window.Vue = require('vue');
import vuetify from '@/plugins/vuetify';
import Route from '@/js/routes';
import App from '@/App';
import store from '@/store';
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.component('basic-button', require('@/components/utils/BasicButton').default);
Vue.component('loader', require('@/components/utils/Loader').default);
Vue.use(VueAxios, axios);
const app = new Vue({
    el: '#app',
    vuetify,
    router: Route,
    store,
    render: h => h(App)
});
