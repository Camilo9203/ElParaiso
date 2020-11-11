@extends('layouts.app', ['activePage' => 'files-manager', 'titlePage' => __('File Manager')])
@section('title',__('File Manager'))
@section('content')
  <div class="content" id="app">
        <app></app>
      {{-- <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="row">
                      <div class="col-12 text-left">
                          <a href="" data-toggle="modal" data-target="#folderModal" class="btn btn-md btn-primary"><span class="material-icons">create_new_folder</span> Nueva Carpeta</a>
                      </div>
                      <div class="card">
                          <div class="card-header card-header-primary">
                              <h4 class="card-title ">Gestor de archivos</h4>
                              <p class="card-category">Aquí puede administrar archivos</p>
                          </div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table id="folderTable" class="table table-hover table-striped text-center" style="width:100%">
                                      <thead class="text-primary">
                                          <th>Cedula</th>
                                          <th>Nombre</th>
                                          <th>Fecha de creación</th>
                                          <th>Fecha de actualización</th>
                                          <th>Archivos</th>
                                          <th>Acciones</th>
                                      </thead>
                                      <tbody>
                                          <tr v-for="folder in folders" v-bind:key="folder.id">
                                              <td><a href="" v-text="folder.id"></a></td>
                                              <td v-text="folder.name"></td>
                                              <td v-text="since(folder.created_at)"></td>
                                              <td v-text="dirHuman(folder.updated_at)"></td>
                                              <td class="text-primary">
                                                  <a href="" v-text="folder.files.length"></a> 
                                              </td>
                                              <td class="td-actions">
                                                  <a href="#" @click.prevent="loadFieldsUpdate(folder)">
                                                      <i class="material-icons">edit</i>
                                                      <div class="ripple-container"></div>
                                                  </a>
                                                  <a href="#" @click.prevent="deleteFolder(folder)">
                                                      <i class="material-icons">delete</i>
                                                  </a>
                                              </td>
                                          </tr> 
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <form id="filesManager" class="form" method="POST" @submit.prevent="saveFolder()">
      <!-- Modal -->
          <div class="modal" id="folderModal"  aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  
                      <div class="modal-body">
                          <div class="card">
                              <div class="card-header card-header-primary text-center">
                                  <h4 v-if="update == 0" class="card-title"><strong>Crear Carpeta</strong></h4>
                                  <h4 v-if="update != 0" class="card-title"><strong>Editar Carpeta</strong></h4>

                              </div>

                              <div class="card-body ">
                                  <div class="bmd-form-group{{ $errors->has('id') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">person_add</i>
                                        </span>
                                        </div>
                                        <input type="number" maxlength="10" v-model="id" class="form-control" placeholder="Cedula" value="" required>
                                    </div>
                                    @if ($errors->has('id'))
                                        <div id="id-error" class="error text-danger pl-3" for="id" style="display: block;">
                                        <strong>{{ $errors->first('id') }}</strong>
                                        </div>
                                    @endif
                                  </div>
                                  <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">face</i>
                                        </span>
                                        </div>
                                        <input type="name" v-model="name" class="form-control" placeholder="Nombre" value="" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                  </div>
                                  <div class="card-footer justify-content-center">
                                      <button @click="clearFields()" type="button" class="btn btn-secondary" data-dismiss="modal" data-backdrop="false">Cerrar</button>
                                      <button v-if="update == 0" @click="saveFolder()" type="submit" class="btn btn-primary">Crear Carpeta</button>
                                      <button v-if="update != 0" @click="updateFolder()" type="submit" class="btn btn-primary">Editar Carpeta</button>
                                    </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

      </form> --}}
  </div>
@endsection
