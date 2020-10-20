@extends('layouts.app', ['activePage' => 'create-folder', 'titlePage' => 'Carpeta de ' . $folder->name])
@section('title', 'Folder | ' . $folder->name)
@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-12 text-left">
              <a href="{{ route('folders.create') }}" class="btn btn-md btn-primary"><span class="material-icons">archive</span> Añadir Documento</a>
            </div>
          </div>
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Archivos de {{ $folder->name }}</h4>
              <p class="card-category"> </p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>
                      Nombre
                    </th>
                    <th>
                      Categoria
                    </th>
                    <th>
                      Fecha de creación
                    </th>
                    <th>
                      Fecha de actualización
                    </th>
                    <th>
                      Archivo
                    </th>
                  </thead>
                  <tbody>
                    {{-- @forelse ($files as $file)
                      <tr>
                        <td>
                          <a href="">{{ $file->name }}</a>
                        </td>
                        <td>
                          {{ $file->category }}
                        </td>
                        <td>
                          {{ $file->created_at }}
                        </td>
                        <td>
                          {{ $file->updated_at }}
                        </td>
                        <td class="text-primary">
                          <a href="">$23,789</a> 
                        </td>
                      </tr>
                    @empty
                    
                        <tr>
                          <td>No hay registros</td>
                        </tr>
                        
                    @endforelse --}}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection