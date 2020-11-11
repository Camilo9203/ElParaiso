@extends('layouts.app', ['activePage' => 'files-manager', 'titlePage' => __('File Manager')])
@section('title',__('File Manager'))
@section('content')
  <div class="content" id="app">
    <div class="col-12">
        <div class="col-12 text-left">
            <a href="" data-toggle="modal" data-target="#fileModal" class="btn btn-sm btn-primary"><span class="material-icons">attachment</span> Nuevo Archivo</a>
            <a href="" data-toggle="modal" data-target="#categoryModal" class="btn btn-sm btn-primary"><span class="material-icons">category</span> Crear Categoria</a>
        </div>             
    </div>
    <!-- Modal -->
</div>
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-body">
                <div class="card">
                    <div class="card-header card-header-primary text-center">
                        <h4 class="card-title"><strong>Crear Archivo</strong></h4>
                    </div>
                    <div class="card-body ">
                        {{-- Name --}}
                        <div class="bmd-form-group mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">face</i>
                                </span>
                                </div>
                                <input type="name" name="name" class="form-control" placeholder="Nombre" required>
                            </div>
                        </div>

                        {{-- Created {{ $errors->has('date') ? ' has-danger' : '' }} --}}
                        <div class="bmd-form-group mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">date_range</i>
                                </span>
                                </div>
                                <input type="date" name="date" class="form-control" placeholder="Fecha de creación" required>
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="bmd-form-group mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">category</i>
                                    </span>
                                </div>
                                <select class="custom-select" name="category" id="">
                                        <option selected>Seleccionar</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                </select>
                            
                            </div>
                            {{-- @if ($errors->has('category'))
                                <div id="name-error" class="error text-danger pl-3" for="category" style="display: block;">
                                <strong>{{ $errors->first('category') }}</strong>
                                </div>
                            @endif --}}
                        </div>

                        {{-- File --}}
                        <div class="bmd-form-group mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">attach_file</i>
                                    </span>
                                </div>
                            <input type="file" name="file" class="form-control">
                            
                            </div>
                        </div>



                        {{-- Buttons --}}
                        <div class="card-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Crear Archivo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
