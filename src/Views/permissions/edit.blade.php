@extends(config('cw_entrust.layout'))
@section('title', __('permission::titles.permissions'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2 offset-10 mb-3 text-right">
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">
                    Editar permissão
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {!! Form::model($permission, ['route' => ['admin.permissions.update', $permission->id], 'method' => 'put']) !!}
                    @include(config('cw_entrust.views') . 'permissions.partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection