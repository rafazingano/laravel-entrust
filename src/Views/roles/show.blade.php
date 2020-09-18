@extends(config('cw_acl.layout'))
@section('title', __('acl::titles.roles.show'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-6 mb-3 text-right">
                <div class="btn-group" role="group" aria-label="Basic">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-light btn-sm">
                        Lista de perfis
                    </a>
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                        Novo Perfil
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">                
                <div class="jumbotron">
                    <h1 class="display-4">{{ $role->display_name }} ({{ $role->name }})</h1>
                    <p class="lead">{{ $role->description }}</p>
                    <hr class="my-4">
                    <p>Tenha sempre cuidado ao editar os perfis, pois eles influenciam diretamente no sistema.</p>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.edit', $role->id) }}" role="button">Editar</a>
                </div>
            </div>
        </div>
    </div>
@endsection