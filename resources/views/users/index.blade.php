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
                <table id="userTable" class="table table-striped text-center" style="width:100%">
                  <thead class=" text-primary">
                    <tr>
                      <th>Nombre</th>
                      <th>Correo Electrónico</th>
                      <th>Fecha de Creación</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                      @if ($user->email != auth()->user()->email) 
                        <tr>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->created_at }}</td>
                          <td class="td-actions">
                            <a rel="tooltip"  data-toggle="modal" data-target="#userModal" class="btn btn-success btn-link" href="" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>
                            <a href="">
                              <i class="material-icons">delete</i>
                            </a> 
                          </td>
                        </tr>
                      @endif
                    @empty
                    @endforelse
                  </tbody>
                </table>
              </div>
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
@section('scripts')
  <script>
      $('#userTable').DataTable({
        
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
        } 
      });
  </script>
@endsection
