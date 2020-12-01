// import $ from 'jquery';
// window.$ = window.jQuery = $;
import axios from 'axios';
import moment from 'moment';
import swal from 'sweetalert';
import vSelect from 'vue-select';
import VueResouerce from 'vue-resource';
import Vuelidate from 'vuelidate'

// require('./bootstrap');

window.Vue = require('vue');

Vue.component('app', require('./components/AppComponent.vue').default)
Vue.component('v-select', vSelect)
Vue.use(VueResouerce)
Vue.use(Vuelidate)
moment.locale('es')
import router from './routes'

const app = new Vue({
    el: '#app',
    router

});

