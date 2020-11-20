<template>
<div class="col-12">
    <div class="col-12 text-left">
        <a href="" data-toggle="modal" data-target="#folderModal" class="btn btn-md btn-primary"><span class="material-icons">create_new_folder</span> Nueva Carpeta</a>
    </div>
    
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">Gestor de archivos</h4>
            <p class="card-category">Aquí puede administrar archivos</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="folderTable" class="table table-hover table-striped text-center" style="width:100%">
                    <thead class="text-primary">
                        <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Archivos</th>
                        <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="folder in folders" v-bind:key="folder.id">
                            <td>
                                <router-link :to="{name: 'folder', params: {id: folder.id}}"
                                    v-text="folder.id"
                                ></router-link>    
                            </td>
                            <td v-text="folder.name"></td>
                            <td v-text="since(folder.created_at)"></td>
                            <td v-text="dirHuman(folder.updated_at)"></td>
                            <td class="text-primary">
                                <router-link :to="{name: 'folder', params: {id: folder.id}}"
                                    v-text="folder.files.length"
                                ></router-link> 
                            </td>
                            <td class="td-actions">
                                <a href="#" @click.prevent="loadFieldsUpdate(folder)">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                </a>
                                <a href="#" @click="deleteFolder(folder)">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="folderModal"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header card-header-primary text-center">
                            <h4 v-if="update == 0" class="card-title"><strong>Crear Carpeta</strong></h4>
                            <h4 v-if="update != 0" class="card-title"><strong>Editar Carpeta</strong></h4>
                        </div>
                        <div class="card-body ">
                            <div class="form-group">
                                <div class="bmd-form-group mt-3" :class=" {'has-danger': $v.id.$error}">
                                    <div class="input-group"> 
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">person_add</i>
                                    </span>
                                    </div>
                                    <input v-if="update == 0" type="number" v-model.number="$v.id.$model" class="form-control" placeholder="Cedula" required>
                                    <input v-if="update != 0" readonly type="number" v-model="id" class="form-control" placeholder="Cedula" required>
                                </div>
                                    <div v-if="!$v.id.required" class="error text-danger pl-3" for="name" style="display: block;">
                                        <strong>Campo cedula es requerido</strong>
                                    </div>
                                    <div v-if="!$v.id.minLength" class="error text-danger pl-3" for="name" style="display: block;">
                                        <strong>Minimo 4 digitos</strong>
                                    </div>
                                    <div v-if="!$v.id.maxLength" class="error text-danger pl-3" for="name" style="display: block;">
                                        <strong>Maximo 14 digitos</strong>
                                    </div>
                                </div>
                                <div class="bmd-form-group mt-3" :class="{'has-danger': $v.name.$error}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">face</i>
                                    </span>
                                    </div>
                                    <input type="name" id="name" v-model="$v.name.$model" class="form-control" placeholder="Nombre" value="" required>
                                </div>
                                    <div v-if="!$v.name.required" class="error text-danger pl-3" for="name" style="display: block;">
                                        <strong>Campo nombre es requerido</strong>
                                    </div>
                                    <div v-if="!$v.name.minLength" class="error text-danger pl-3" for="name" style="display: block;">
                                        <strong>Minimo 4 caracteres</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer justify-content-center">
                                <button @click.prevent="clearFields()" type="button" class="btn btn-secondary" data-dismiss="modal" data-backdrop="false">Cerrar</button>
                                <button v-if="update == 0" :disabled="$v.$invalid" @click="saveFolder()" type="submit" class="btn btn-primary">Crear Carpeta</button>
                                <button v-if="update != 0" @click="updateFolder(id)" type="submit" class="btn btn-primary">Editar Carpeta</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import moment from 'moment'
    import axios from 'axios'
    import { required, numeric, minLength, maxLength } from 'vuelidate/lib/validators'
    moment.locale('es');

    export default {
        
        data() {
            return {
                categories: [],
                files: [],
                folders: [],
                errors: [],
                name: null,
                description: null,
                created: '',
                category_id: '',
                folder_id: '',
                file: '',
                path: '',
                id: '',
                update:0,
            }
        },
         created() {
            this.getFolders();
        },
        validations: {
            id: {required, minLength: minLength(4), maxLength: maxLength(14), numeric},
            name: {required, minLength: minLength(4)},
        },
        methods: {

            mayus: function (){
                $('#name').keyup(function() {
                    var datos = new String($('#name').val());
                    datos = datos.trim().toLowerCase().replace(/\w\S*/g, (w) => (w.replace(/^\w/, (c) => c.toUpperCase())));
                    //datos = datos.toUpperCase(datos);
                    $('#name').val(datos);
                });
                //e.value = e.value.toUpperCase();
            },
            folderTable: function (){
                $(function(){
                    $('#folderTable').DataTable({
                        language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
                        },
                        retrieve: true,
                        paging: true,
                    });
                });
            },
            getFolders: function(){
                var url = '/folder-manager'
                axios.get(url).then(response => {
                    this.folders = response.data;
                    this.folderTable();
                });
            },

            since: function(d){
                return moment(d).format('LL');
            },
            dirHuman: function(d){
                return moment(d).fromNow();
            },
        
            saveFolder: function(){
                var url = '/folder-manager';
                axios.post(url, {
                    id: this.id,
                    name: this.name.trim().toLowerCase().replace(/\w\S*/g, (w) => (w.replace(/^\w/, (c) => c.toUpperCase())))
                    }).then(response => {
                    this.getFolders();
                    this.id = '';
                    this.name = '';
                    this.errors = [];
                    swal("¡Buen trabajo!", "¡Carpeta creada con exito!", "success");
                    $('#folderModal').modal('hide');
                }).catch(error =>  {
                    console.log(error.response.data.errors);
                    this.errors = error.response.data.errors;
                    swal("¡La carpeta no fue creada!", "Revisa la información y vuelve a intentar", "warning");

                });
            
            },
            updateFolder: function (id){ 
                var url = '/folder-manager/' + id;
                axios.put(url, {
                    id: this.id,
                    name: this.name.trim().toLowerCase().replace(/\w\S*/g, (w) => (w.replace(/^\w/, (c) => c.toUpperCase())))
                }).then(response => {
                    swal("!Buen trabajo!", "Carpeta actualizad con exito!", "success");
                    $('#folderModal').modal('hide');
                    this.id = '';
                    this.name = '';
                    this.errors = [];
                    this.clearFields();
                    this.getFolders();
                }).catch(error => {
                    // console.log(error.response.data.errors)
                    // this.errors = error.response.data;
                    swal("¡La carpeta no fue actualizada!", "Revisa la información y vuelve a intentar", "warning")
                });
            },
            
            deleteFolder: function(folder){
                var url = 'folder-manager/' + folder.id;
                swal({
                    title: "¿Estás seguro?",
                    text: "Una vez eliminado, usted no será capaz de recuperar este carpeta!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete(url).then(response => {
                            swal("¡Buen trabajo!", "La carpeta fue eliminada con exito", "success");
                            this.getFolders();
                        }).catch(function(error){
                            swal("¡La carpeta no fue eliminada!", "Esta carpeta contiene archivos", "warning");
                        });
                    } else {
                    swal("¡Tu carpeta esta a salvo!");
                    }
                });

            },
            loadFieldsUpdate: function(folder) {
                this.update = folder.id
                var url = 'folder-manager/' + folder.id;
                $('#folderModal').modal('show');

                axios.get(url).then(response => {
                    this.id = response.data.id;
                    this.name = response.data.name;  
                }).catch (function (error){
                    console.log(error)
                });
            
            },
            clearFields: function (){
                $('#folderModal').modal('hide');
                this.id = "";
                this.name = "";
                this.update = 0;
                this.errors = [];
            }
        }
    }
</script>
