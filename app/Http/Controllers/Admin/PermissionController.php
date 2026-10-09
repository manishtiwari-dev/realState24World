<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Models\ModulePermission;

class PermissionController extends Controller
{
    /**
     * create a new instance of the class
     *
     */
    function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        $query = Permission::query();
        // Apply filters 
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            });
        }
        $data = $query->orderBy('id', 'DESC')->get();
        return view('admin.permissions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modulelist = ModulePermission::get();
        return view('admin.permissions.create', compact('modulelist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'module' => 'required',
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create([
            'name' => $request->input('name'),
            'module_id' => $request->input('module'),
            'guard_name' => 'web'
        ]);
        return redirect()->route(getRolePrefix() . 'permissions.index')->with('success', 'Permission created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        $modulelist = ModulePermission::get();
        return view('admin.permissions.edit', compact('permission', 'modulelist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'module' => 'required',
            'name' => 'required'
        ]);

        $permission = Permission::find($id);
        $permission->module_id = $request->input('module');
        $permission->name = $request->input('name');
        $permission->save();

        return redirect()->route(getRolePrefix() . 'permissions.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect()->route(getRolePrefix() . 'permissions.index')->with('success', 'Permission deleted successfully');
    }
}
