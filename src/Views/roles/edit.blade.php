@extends(config('cw_entrust.layout'))
@section('title', __('role::titles.roles'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2 offset-10 mb-3 text-right">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                    Editar Perfil
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {!! Form::model($role, ['route' => ['admin.roles.update', $role->id], 'method' => 'put']) !!}
                    @include(config('cw_entrust.views') . 'roles.partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection