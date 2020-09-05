<?php

namespace ConfrariaWeb\Entrust\Controllers;

use App\Http\Controllers\Controller;
use ConfrariaWeb\Entrust\Requests\StoreRole;
use ConfrariaWeb\Entrust\Requests\UpdateRole;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Config;
class RoleController extends Controller
{

    protected $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function datatables(){
        $roles = resolve('RoleService')->all();
        return DataTables::of($roles)
            ->editColumn('created_at', function ($roles) {
                return $roles->created_at ? $roles->created_at->format('d/m/Y') : NULL;
            })
            ->editColumn('updated_at', function ($roles) {
                return $roles->updated_at ? $roles->updated_at->format('d/m/Y') : NULL;
            })
        ->addColumn('action', function ($role) {
            return '<div class="btn-group btn-group-sm float-right" role="group">
                <a href="'.route('admin.roles.show', $role->id).'" class="btn btn-sm btn-info">
                    <i class="glyphicon glyphicon-eye"></i> Ver
                </a>
                <a href="'.route('admin.roles.edit', $role->id).'" class="btn btn-sm btn-primary">
                    <i class="glyphicon glyphicon-edit"></i> Editar
                </a>
                <a class="btn btn-sm btn-danger" href="'.route('admin.roles.destroy', $role->id).'" onclick="event.preventDefault();
                    document.getElementById(\'roles-destroy-form-' . $role->id . '\').submit();">
                    Deletar
                </a>
                <form id="roles-destroy-form-' . $role->id . '" action="'.route('admin.roles.destroy', $role->id).'" method="POST" style="display: none;">
                    <input name="_method" type="hidden" value="DELETE">    
                    <input name="_token" type="hidden" value="'. csrf_token() .'">
                    <input type="hidden" name="id" value="'.$role->id.'">
                </form>
            </div>';
        })
        ->make();
    }

    public function index()
    {
        return view(Config::get('cw_entrust.views') . 'roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['permissions'] = resolve('PermissionService')->pluck();
        return view(Config::get('cw_entrust.views') . 'roles.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
        $data = $request->all();
        $role = resolve('RoleService')->create($data);
        return redirect()
            ->route('admin.roles.edit', $role->id)
            ->with('status', 'Perfil criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['role'] = resolve('RoleService')->find($id);
        return view(Config::get('cw_entrust.views') . 'roles.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['permissions'] = resolve('PermissionService')->pluck();
        $this->data['role'] = resolve('RoleService')->find($id);
        return view(Config::get('cw_entrust.views') . 'roles.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRole $request, $id)
    {
        $role = resolve('RoleService')->update($request->all(), $id);
        return redirect()
            ->route('admin.roles.edit', $role->id)
            ->with('status', 'Perfil editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = resolve('RoleService')->destroy($id);
        return redirect()
            ->route('admin.roles.index')
            ->with('status', 'Perfil deletado com sucesso!');
    }
}
