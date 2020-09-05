<div class="form-group">
    <label class="control-label">Nome do display <span class="required"> * </span></label>
    {!! Form::text('display_name', isset($permission) ? $permission->display_name : null, ['class' => 'form-control', 'placeholder' => 'Digite o nome de display da permissão', 'required']) !!}
</div>
<div class="form-group">
    <label class="control-label">Nome <span class="required"> * </span></label>
    {!! Form::text('name', isset($ropermissione) ? $permission->name : null, ['class' => 'form-control', 'placeholder' => 'Digite o nome da permissão', 'required']) !!}
</div>
<div class="form-group">
    <label class="control-label">Descrição <span class=""> </span></label>
    {!! Form::textarea('description', isset($permission) ? $permission->description : null, ['class' => 'form-control', 'placeholder' => 'Digite a descrição da permissão', 'required']) !!}
</div>
