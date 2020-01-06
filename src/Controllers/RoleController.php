<?php

namespace ConfrariaWeb\Entrust\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    protected $data;

    public function __construct()
    {
        $this->data = [];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['roles'] = resolve('RoleService')->all();

        return view('roles.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['statuses'] = resolve('StatusService')->pluck();
        $this->data['options'] = resolve('OptionService')->pluck();
        $this->data['roles'] = resolve('RoleService')->pluck();
        $this->data['steps'] = resolve('StepService')->pluck();
        $this->data['types_tasks'] = resolve('TaskTypeService')->pluck();
        $this->data['permissions'] = resolve('PermissionService')->pluck();
        return view('roles.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['role'] = resolve('RoleService')->find($id);
        return view('roles.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['statuses'] = resolve('StatusService')->pluck();
        $this->data['options'] = resolve('OptionService')->pluck();
        $this->data['roles'] = resolve('RoleService')->pluck();
        $this->data['steps'] = resolve('StepService')->pluck();
        $this->data['types_tasks'] = resolve('TaskTypeService')->pluck();
        $this->data['permissions'] = resolve('PermissionService')->pluck();
        $this->data['role'] = resolve('RoleService')->find($id);

        return view('roles.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
     * @param  int  $id
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
