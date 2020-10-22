@extends('layouts.app', ['activePage' => 'files-manager', 'titlePage' => __('File Manager')])
@section('title',__('File Manager'))
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        @if (session('status'))
        <div class="row">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
              </button>
              <span>{{ session('status') }}</span>
            </div>
          </div>
        </div>
        @endif
        <div class="row">
          <div class="col-12 text-left">
            <a href="" data-toggle="modal" data-target="#folderModal" class="btn btn-md btn-primary"><span class="material-icons">create_new_folder</span> Nueva Carpeta</a>
            
          </div>
        </div>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Gestor de archivos</h4>
            <p class="card-category">Aquí puede administrar archivos</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    Cedula
                  </th>
                  <th>
                    Nombre
                  </th>
                  <th>
                    Fecha de creación
                  </th>
                  <th>
                    Fecha de actualización
                  </th>
                  <th>
                    Archivos
                  </th>
                  <th>
                    Acciones
                  </th>
                </thead>
                <tbody>
                  @forelse ($folders as $folder)
                    <tr>
                      <td>
                        <a href="{{ route('folders.show', $folder) }}">{{ $folder->id }}</a>
                      </td>
                      <td>
                        {{ $folder->name }}
                      </td>
                      <td>
                        {{ $folder->created_at }}
                      </td>
                      <td>
                        {{ $folder->updated_at }}
                      </td>
                      <td class="text-primary">
                        <a href="{{ route('folders.show', $folder) }}">$23,789</a> 
                      </td>
                      <td class="td-actions text-center">
                        <a rel="tooltip" class="btn btn-success btn-link" href="" data-original-title="" title="">
                          <i class="material-icons">edit</i>
                          <div class="ripple-container"></div>
                        </a>
                        <a href="" data-toggle="modal" data-target="#deleteAlert">
                          <i class="material-icons">delete</i>
                        </a>
                      </td>
                    </tr>
                  @empty
                  
                      <tr>
                        <td>No hay registros</td>
                      </tr>
                      
                  @endforelse
                  {{ $folders->links() }}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<form class="form" method="POST" action="{{ route('folders.store') }}">
  @include('folders._form', ["titleCard" => 'Nueva Carpeta', "btnText" => 'Crear Carpeta'])
</form>
@endsection