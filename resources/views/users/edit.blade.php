@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Edit Account')])
@section('title',__('Edit Account'))
@section('content')
<div class="content">
    <div class="container" class="container-fluid">
        <div class="col-12">
            <form class="form" method="POST" action="{{ route('user.update', $user) }}">
                @method('PATCH')
                @include('users._form', ['btnText' => 'Guardar Cuenta', 'titleCard' => 'Editar Cuenta'])
            </form>
        </div>
    </div>
</div>    
@endsection