<div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Nome do display <span class="required"> * </span></label>
                {!! Form::text('display_name', isset($role)? $role->display_name : null, ['class' => 'form-control', 'placeholder' => 'Digite o nome de display do perfil', 'required']) !!}
            </div>
            <div class="form-group">
                <label class="control-label">Nome <span class="required"> * </span></label>
                {!! Form::text('name', isset($role)? $role->name : null, ['class' => 'form-control', 'placeholder' => 'Digite o nome do perfil', 'required']) !!}
            </div>
            <div class="form-group">
                <label class="control-label">Descrição <span class=""> </span></label>
                {!! Form::textarea('description', isset($role)? $role->description : null, ['class' => 'form-control', 'placeholder' => 'Digite a descrição do perfil', 'required']) !!}
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Permissões do perfil</label>
                {{ Form::select('sync[permissions][]', $permissions, isset($role)? $role->permissions->pluck('id') : null, ['class' => 'form-control select2 kt-select2', 'multiple'=>true]) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {!! Form::submit('Salvar') !!}
        </div>
    </div>    
</div>