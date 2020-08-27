@extends(config('cw_entrust.layout'))
@section('title', __('entrust::titles.permissions.show'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-6 mb-3 text-right">
                <div class="btn-group" role="group" aria-label="Basic">
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-light btn-sm">
                        Lista de permissões
                    </a>
                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">
                        Nova permissão
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">                
                <div class="jumbotron">
                    <h1 class="display-4">{{ $permission->display_name }} ({{ $permission->name }})</h1>
                    <p class="lead">{{ $permission->description }}</p>
                    <hr class="my-4">
                    <p>Tenha sempre cuidado ao editar as permissões, pois eles influenciam diretamente no sistema.</p>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.permissions.edit', $permission->id) }}" role="button">Editar</a>
                </div>
            </div>
        </div>
    </div>
@endsection