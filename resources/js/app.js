// import $ from 'jquery';
// window.$ = window.jQuery = $;
import axios from 'axios';
import moment from 'moment';
import swal from 'sweetalert';
import vSelect from 'vue-select';
import VueResouerce from 'vue-resource';
import VueHasErrorLaravel from 'vue-has-error-laravel'


// import 'jquery-ui/ui/widgets/datepicker.js';
// import 'datatables.net/js/jquery.dataTables';
// import 'datatables.net-dt/js/dataTables.dataTables';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web sapplications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('app', require('./components/AppComponent.vue').default)
// Vue.component('manager-file', require('./components/ManagerFileComponent').default)
Vue.component('v-select', vSelect)
Vue.use(VueResouerce)
Vue.use(VueHasErrorLaravel)
moment.locale('es')
import router from './routes'

const app = new Vue({
    el: '#app',
    router

});

// const app = new Vue({
//     el: '#app',
//     data: {
//         categories: [],
//         files: [],
//         folders: [],
//         name: null,
//         description: null,
//         created: '',
//         category_id: '',
//         folder_id: '',
//         file: '',
//         path: '',
//         errors: [],
//         id: '',
//         update:0,
//     },
//     created() {
//         this.getFolders();      
//     },
//     methods: {

//         folderTable: function (){
//             $(function(){
//                 $('#folderTable').DataTable({
//                     language: {
//             url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
//         }
//                 });
//             });
//         },
//         getFolders: function(){
//             var url = '/folder-manager'
//             axios.get(url).then(response => {
//                 this.folders = response.data;
//                 this.folderTable(); 
//                 });
//             axios.get("api/folders").then(response=>{
//                 this.files = response.data.files
//             })
//         },

//         since: function(d){
//             return moment(d).format('LL');
//         },
//         dirHuman: function(d){
//             return moment(d).fromNow();
//         },
    
//         saveFolder: function(){
//             var url = '/folder-manager';
//             axios.post(url, {
//                 id: this.id,
//                 name: this.name,
//                 }).then(response => {
//                 this.getFolders();
//                 this.id = '';
//                 this.name = '';
//                 this.errors = [];
//                 swal("¡Buen trabajo!", "¡Carpeta creada con exito!", "success");
//                 $('#folderModal').modal('hide');
//             }).catch(function(error) {
//                 swal("¡La carpeta no fue creada!", "Revisa la información y vuelve a intentar", "warning");
//                 });
//         },
//         updateFolder: function (){
//             var url = '/folder-manager/update'
//         },
        
//         deleteFolder: function(folder){
//             var url = 'folder-manager/' + folder.id;
//             swal({
//                 title: "¿Estás seguro?",
//                 text: "Una vez eliminado, usted no será capaz de recuperar este carpeta!",
//                 icon: "warning",
//                 buttons: true,
//                 dangerMode: true,
//               })
//               .then((willDelete) => {
//                 if (willDelete) {
//                     axios.delete(url).then(response => {
//                         this.getFolders();
//                         swal("¡Buen trabajo!", "La carpeta fue eliminada con exito", "success");
//                     }).catch(function(error){
//                         swal("¡La carpeta no fue eliminada!", "Esta carpeta contiene archivos", "warning");
//                     });
//                 } else {
//                   swal("¡Tu carpeta esta a salvo!");
//                 }
//               });

//         },
//         loadFieldsUpdate: function(folder) {
//             this.update = folder.id
//             var url = 'folder-manager/' + folder.id;
//             $('#folderModal').modal('show');

//             axios.get(url).then(response => {
//                 this.id = response.data.id;
//                 this.name = response.data.name;  
//           }).catch (function (error){
//               console.log(error)
//           });
          
//         },
//         clearFields: function (){
//             $('#folderModal').modal('hide');
//             this.id = "";
//             this.name = "";
//             this.update = 0;
//         }
//     }
// })



