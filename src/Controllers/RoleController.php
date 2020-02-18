<?php

namespace ConfrariaWeb\Entrust\Controllers;

use App\Http\Controllers\Controller;
use ConfrariaWeb\Entrust\Resources\Select2RoleResource;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    protected $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function select2(Request $request)
    {
        $data = $request->all();
        $data['name'] = isset($data['term'])? $data['term'] : NULL;
        $status = resolve('RoleService')->where($data)->get();
        return Select2RoleResource::collection($status);
    }

    public function index()
    {
        $this->data['roles'] = resolve('RoleService')->all();
        return view(config('cw_entrust.views') . 'entrust.roles.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['statuses'] = resolve('UserStatusService')->pluck();
        $this->data['options'] = resolve('OptionService')->pluck();
        $this->data['roles'] = resolve('RoleService')->pluck();
        $this->data['steps'] = resolve('CrmStepService')->pluck();
        $this->data['types_tasks'] = resolve('TaskTypeService')->pluck();
        $this->data['permissions'] = resolve('PermissionService')->pluck();
        return view(config('cw_entrust.views') . 'entrust.roles.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = resolve('RoleService')->create($request->all());
        return redirect()
            ->route('roles.edit', $role->id)
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
        return '';
        //$this->data['role'] = resolve('RoleService')->find($id);
        //return view(config('cw_entrust.views') . 'entrust.roles.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['statuses'] = resolve('StatusService')->pluck();
        $this->data['options'] = resolve('OptionService')->pluck();
        $this->data['roles'] = resolve('RoleService')->pluck();
        $this->data['steps'] = resolve('CrmStepService')->pluck();
        $this->data['types_tasks'] = resolve('TaskTypeService')->pluck();
        $this->data['permissions'] = resolve('PermissionService')->pluck();
        $this->data['role'] = resolve('RoleService')->find($id);

        return view(config('cw_entrust.views') . 'entrust.roles.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = resolve('RoleService')->update($request->all(), $id);
        return redirect()
            ->route('roles.edit', $role->id)
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
            ->route('roles.index')
            ->with('status', 'Perfil deletado com sucesso!');
    }
}
