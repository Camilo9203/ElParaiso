@extends('layouts.app', ['activePage' => 'files-manager', 'titlePage' => __('File Manager')])
@section('title',__('File Manager'))
@section('content')

@section('content')

{{-- Content --}}
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-12 text-left">
              <a href="" data-toggle="modal" data-target="#fileModal" class="btn btn-md btn-primary"><span class="material-icons">unarchive</span>Añadir Documento</a>
              <a href="" data-toggle="modal" data-target="#categoryModal" class="btn btn-md btn-primary"><span class="material-icons">category</span>Añadir Categoria</a>            
            </div>
          </div>
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Archivos de {{ $folder->name }}</h4>
              <p class="card-category"> </p>
            </div>
            <div class="card-body">            
                @include('categories._index')           
            </div>
            <pre>
              @{{ $data }}
            </pre>  
          </div>
          </div>
        </div>
      </div>
      {{-- Forms --}}
      @include('files._form', ["titleCard" => 'Crear Archivo', "btnText" => 'Crear Archivo'])
      @include('categories._form', ["titleCard" => 'Nueva Categoria', "btnText" => 'Crear Categoria'])
    </div>
    

  



@endsection