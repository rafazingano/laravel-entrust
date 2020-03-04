<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Formulário de perfis
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
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
                @foreach(config('cw_entrust.form.settings') as $setting_k => $setting_v)
                    <div class="form-group">
                        @if('checkbox' != $setting_v['type'])
                            <label class="control-label">{{ $setting_v['label'] }}</label>
                            {!! Form::{$setting_v['type']}(
                                    'settings['. $setting_v['name'] .']',
                                    isset($role->settings[$setting_v['name']])? $role->settings[$setting_v['name']] : NULL,
                                    ['class' => 'form-control', 'placeholder' => $setting_v['placeholder']]
                                ) !!}
                        @endif
                        @if('checkbox' == $setting_v['type'])
                            <div class="form-check">
                                {{ Form::{$setting_v['type']}(
                                    'settings[' . $setting_v['name'] . ']',
                                    1,
                                    isset($role->settings[$setting_v['name']])? true : false,
                                    ["class" => "form-check-input"]
                                ) }}
                                <label class="form-check-label" for="defaultCheck1">{{ $setting_v['label'] }}</label>
                            </div>
                        @endif
                    </div>
                @endforeach
                <div class="form-group">
                    <label class="control-label">Campos adicionais para pessoas deste perfil </label>
                    {{ Form::select('sync[options][]', $options, isset($role->options)? $role->options()->pluck('options.id') : null, ['class' => 'form-control kt-select2', 'multiple' => true]) }}
                    <small class="form-text text-muted">
                        Campos adicionais para o cadastro destas pessoas, todos os campos
                        adicionados aqui apareceram como opções a mais no formulario de pessoas.
                    </small>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Etapas de crm </label>
                    {{ Form::select('sync[steps][]', $steps, isset($role->steps)? $role->steps->pluck('id') : null, ['class' => 'form-control select2 kt-select2', 'multiple'=>true]) }}
                    <small class="form-text text-muted">
                        Estas etapas ficarao disponiveis para todos os usuarios com este
                        perfil e serão utilizadas na distribuição do KanBan por exemplo.
                    </small>
                </div>
                <div class="form-group">
                    <label class="control-label">Etapa do usuário aos ser criada com este perfil </label>
                    {{ Form::select('sync[stepWhenCreatingUser][]', $steps, isset($role->stepWhenCreatingUser)? $role->stepWhenCreatingUser->pluck('id') : null, ['class' => 'form-control kt-select2']) }}
                    <small class="form-text text-muted">
                        Esta será a Fase da pessoa aos ser criada com este perfil.
                        Caso seja criada com dois ou mais perfis o mesmo contera todas as fases
                    </small>
                </div>
                <div class="form-group">
                    <label class="control-label">Permissões do perfil</label>
                    {{ Form::select('sync[permissions][]', $permissions, isset($role)? $role->permissions->pluck('id') : null, ['class' => 'form-control select2 kt-select2', 'multiple'=>true]) }}
                </div>
            </div>
        </div>
    </div>
    @include('meridien::partials.portlet_footer_form_actions')
</div>