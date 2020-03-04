<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Listagem de Perfis
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="kt-section">
            <div class="kt-section__content">

                <table class="table table-striped table-hover" id="roles_datatable">
                    <thead>
                    <tr>
                        <th width="">Nome de Display</th>
                        <th width="">Nome</th>
                        <th width="">Descrição</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                                <div class="btn-group btn-group-sm float-right" role="group" aria-label="...">
                                    @permission('roles.show')
                                    <a href="{{ route('admin.roles.show', $role->id) }}"
                                       class="btn btn-clean btn-icon btn-label-primary btn-icon-md " title="View">
                                        <i class="la la-eye"></i>
                                    </a>
                                    @endpermission
                                    @permission('roles.edit')
                                    <a href="{{ route('admin.roles.edit', $role->id) }}"
                                       class="btn btn-clean btn-icon btn-label-success btn-icon-md " title="Edit">
                                        <i class="la la-edit"></i>
                                    </a>
                                    @endpermission
                                    @permission('roles.destroy')
                                    <a href="javascript:void(0);"
                                       onclick="event.preventDefault();
                                           if(!confirm('Tem certeza que deseja deletar este item?')){ return false; }
                                           document.getElementById('delete-role-{{ $role->id }}').submit();"
                                       class="btn btn-clean btn-icon btn-label-danger btn-icon-md "
                                       title="Deletar">
                                        <i class="la la-remove"></i>
                                    </a>
                                    <form
                                        action="{{ route('admin.roles.destroy', $role->id) }}"
                                        method="POST" id="delete-role-{{ $role->id }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                    </form>
                                    @endpermission
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
