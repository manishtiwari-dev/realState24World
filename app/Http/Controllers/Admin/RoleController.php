<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Helpers\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('admin.roles.index', compact('roles'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        // $permission = Permission::get();
        $permission = Permission::select('permissions.*', 'module_permissions.module as modulename')
            ->leftJoin('module_permissions', 'module_permissions.id', '=', 'permissions.module_id')
            ->get();
        return view('admin.roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $permissionsID = array_map(
            function ($value) {
                return (int)$value;
            },
            $request->input('permission')
        );

        //  $role = Role::create(['name' => $request->input('name')]);
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web'
        ]);

        $role->syncPermissions($permissionsID);
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Roles', 'New Role Created', 'Create', $request->all());
        //=====logs=====
        return redirect()->route(getRolePrefix() . 'roles.index')->with('success', 'Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return view('admin.roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $role = Role::find($id);
        if ($role->name == 'Superadmin') {
            abort(403, 'SUPER ADMIN ROLE CAN NOT BE EDITED');
        }
        //$permission = Permission::get();
        $permission = Permission::select('permissions.*', 'module_permissions.module as modulename')
            ->leftJoin('module_permissions', 'module_permissions.id', '=', 'permissions.module_id')
            ->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $permissionsID = array_map(
            function ($value) {
                return (int)$value;
            },
            $request->input('permission')
        );

        $role->syncPermissions($permissionsID);
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Roles', 'Role Updated', 'Update', $request->all());
        //=====logs=====
        return redirect()->route(getRolePrefix() . 'roles.index')->with('success', 'Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        $role = DB::table('roles')->where('id', $id)->first();
        if ($role->name == 'Superadmin') {
            abort(403, 'SUPER ADMIN ROLE CAN NOT BE DELETED');
        }
        $user = current_auth_user();

        if ($user->hasRole($role->name)) {
            abort(403, 'CAN NOT DELETE SELF ASSIGNED ROLE');
        }
        DB::table("roles")->where('id', $id)->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Roles', 'Role Deleted', 'Delete', $role);
        //=====logs=====
        return redirect()->route(getRolePrefix() . 'roles.index')->with('success', 'Role deleted successfully');
    }
}
