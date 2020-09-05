<?php

namespace ConfrariaWeb\Entrust\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use ConfrariaWeb\Entrust\Requests\StorePermission;
use ConfrariaWeb\Entrust\Requests\UpdatePermission;
use Illuminate\Support\Facades\Config;
use Auth;

class PermissionController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function datatables()
    {
        $permissions = resolve('PermissionService')->all();
        return DataTables::of($permissions)
        ->editColumn('created_at', function ($permissions) {
            return $permissions->created_at ? $permissions->created_at->format('d/m/Y') : NULL;
        })
        ->editColumn('updated_at', function ($permissions) {
            return $permissions->updated_at ? $permissions->updated_at->format('d/m/Y') : NULL;
        })
        ->addColumn('action', function ($permission) {
            return '<div class="btn-group btn-group-sm float-right" role="group">
                <a href="'.route('admin.permissions.show', $permission->id).'" class="btn btn-info">
                    <i class="glyphicon glyphicon-eye"></i> Ver
                </a>
                <a href="'.route('admin.permissions.edit', $permission->id).'" class="btn btn-primary">
                    <i class="glyphicon glyphicon-edit"></i> Editar
                </a>
                <a class="btn btn-danger" href="'.route('admin.permissions.destroy', $permission->id).'" onclick="event.preventDefault();
                    document.getElementById(\'permissions-destroy-form-' . $permission->id . '\').submit();">
                    Deletar
                </a>
                <form id="permissions-destroy-form-' . $permission->id . '" action="'.route('admin.permissions.destroy', $permission->id).'" method="POST" style="display: none;">
                    <input name="_method" type="hidden" value="DELETE">    
                    <input name="_token" type="hidden" value="'. csrf_token() .'">
                    <input type="hidden" name="id" value="'.$permission->id.'">
                </form>
            </div>';
        })
        ->make();
    }

    public function index()
    {
        return view(Config::get('cw_entrust.views') . 'permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(Config::get('cw_entrust.views') . 'permissions.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermission $request)
    {
        $data = $request->all();
        $permission = resolve('PermissionService')->create($data);
        return redirect()
            ->route('admin.permissions.edit', $permission->id)
            ->with('status', 'Permissão criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['permission'] = resolve('PermissionService')->find($id);
        return view(Config::get('cw_entrust.views') . 'permissions.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['permission'] = resolve('PermissionService')->find($id);
        return view(Config::get('cw_entrust.views') . 'permissions.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermission $request, $id)
    {
        $permission = resolve('PermissionService')->update($request->all(), $id);
        return redirect()
            ->route('admin.permissions.edit', $permission->id)
            ->with('status', 'Permissão editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = resolve('PermissionService')->destroy($id);
        return redirect()
            ->route('admin.permissions.index')
            ->with('status', 'Permissão deletado com sucesso!');
    }
}
