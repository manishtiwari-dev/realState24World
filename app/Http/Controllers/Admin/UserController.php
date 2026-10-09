<?php
    
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;    
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\User;
use App\Helpers\Log;
    
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /*** Display a listing of the resource*/
    public function index(Request $request): View
    {
        $data = User::where('is_role', '1')->latest()->get();

        return view('admin.users.index', compact('data'))->with('i');
    }

    /*** Show the form for creating a new resource*/
    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('admin.users.create', compact('roles'));
    }

    /*** Store a newly created resource in storage*/
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password_backup'] = base64_encode($input['password']);
        $input['password'] = Hash::make($input['password']);
        $input['is_role'] = '1';
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('User', 'New User Account Created', 'Create', $request->all());
        //=====logs=====
        return redirect()->route(getRolePrefix().'users.index')->with('success', 'User created successfully');
    }

    /*** Display the specified resource*/
    public function show($id): View
    {
        $user = User::find($id);
        $logsresult = Log::where('user_id', $id)->orderBy('id', 'DESC')->get();
        return view('admin.users.show', compact('user','logsresult'));
    }

    /*** Show the form for editing the specified resource*/
    public function edit($id): View
    {
        $user = User::find($id);
        if ($user->hasRole('Superadmin')) {
            if ($user->id != current_auth_user()->id) {
                abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
            }
        }
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    /*** Update the specified resource in storage*/
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password_backup'] = base64_encode($input['password']);
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $input['is_role'] = '1';
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user = User::find($id);
        if ($user->hasRole('Superadmin')) {
            if ($user->id != current_auth_user()->id) {
                abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
            }
        }
        $user->update($input);
        $user->assignRole($request->input('roles'));
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('User', 'User Account Updated', 'Update', $request->all());
        //=====logs=====
        return redirect()->route(getRolePrefix().'users.index')->with('success', 'User updated successfully');
    }

    /*** Remove the specified resource from storage*/
    public function status(Request $request) 
    {
        if ($request->isMethod('GET')) {
            $user = User::find($request->user_id);
            if ($user->hasRole('Superadmin')) {
                if ($user->id != current_auth_user()->id) {
                    abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
                }
            }
            $user->is_status = $request->status;
            $user->save();
             //=====logs=====
            $logInstance = new Log();
            $logInstance->addToLog('User', 'User Profile Status Updated', 'Update', $request->all());
            //=====logs=====
            return response()->json(['message' => 'User Login status updated successfully.']);
        }
        if ($request->isMethod('POST')) {
            $user = User::find($request->user_id);
            if ($user->hasRole('Superadmin')) {
                if ($user->id != current_auth_user()->id) {
                    abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
                }
            }
            $user->is_status = $request->status;
            $user->save();
             //=====logs=====
            $logInstance = new Log();
            $logInstance->addToLog('User', 'User Profile Status Updated', 'Update', $request->all());
            //=====logs=====
            return redirect()->route(getRolePrefix().'users.show', $request->user_id)->with('success', 'User Login status updated successfully');
        }
    }

    /*** Remove the specified resource from storage*/
    public function destroy($id): RedirectResponse
    {
        $user = User::find($id);
        if ($user->hasRole('Superadmin') || $user->id == current_auth_user()->id) {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }
        User::find($id)->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('User', 'User Account Deleted', 'Delete', $user);
        //=====logs=====
        return redirect()->route(getRolePrefix().'users.index')->with('success', 'User deleted successfully');
    }
}
