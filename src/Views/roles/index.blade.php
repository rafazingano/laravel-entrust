@extends(config('cw_acl.layout'))
@section('title', __('role::titles.roles'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2 offset-10 mb-3 text-right">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                    Novo Perfil
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @include(config('cw_acl.views') . 'roles.partials.list')
            </div>
        </div>
    </div>
@endsection