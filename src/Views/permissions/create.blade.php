@extends(config('cw_acl.layout'))
@section('title', __('permission::titles.permissions'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2 offset-10 mb-3 text-right">
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">
                    Nova permissão
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {!! Form::open(['route' => 'admin.permissions.store']) !!}
                    @include(config('cw_acl.views') . 'permissions.partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection