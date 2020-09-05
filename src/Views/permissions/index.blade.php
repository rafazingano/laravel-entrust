@extends(config('cw_entrust.layout'))
@section('title', __('role::titles.permissions'))
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
                @include('entrust::permissions.partials.list')
            </div>
        </div>
    </div>
@endsection