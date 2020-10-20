@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])
@section('title',__('User Management'))
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
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Usuarios</h4>
              <p class="card-category"> Aquí puede administrar usuarios</p>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 text-right">
                  <a href="" data-toggle="modal" data-target="#userModal" class="btn btn-sm btn-primary">Agregar usuario</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <tr><th>
                      Nombre
                    </th>
                    <th>
                      Correo Electrónico
                    </th>
                    <th>
                      Fecha de Creación
                    </th>
                    <th class="text-right">
                      Acciones
                    </th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                      <tr>
                        <td>
                          {{ $user->name }}
                        </td>
                        <td>
                          {{ $user->email }}
                        </td>
                        <td>
                          {{ $user->created_at }}
                        </td>
                        <td class="td-actions text-center">
                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('user.edit', $user) }}" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>
                            <a href="" onclick="document.getElementById('delete-user').submit()">
                              <i class="material-icons">delete</i>
                            </a>
                            {{-- Fomr destroy user --}}
                            <form id="delete-user"
                            class="d-none"
                            action="{{ route('user.destroy', $user) }}" 
                            method="POST">
                            @csrf  @method('DELETE')
                            </form>   
                        </td>
                    @empty
                      <tr>
                        No hay usuarios para mostrar
                      </tr>
                    @endforelse

                  </tbody>
                </table>
              </div>
              {{ $users->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

{{-- Form Create User --}}
  <form class="form" method="POST" action="{{ route('user.store') }}">
    @include('users._form', ['btnText' => 'Crear Usuario', 'titleCard' => 'Crear Usuario'])
 </form>


@endsection