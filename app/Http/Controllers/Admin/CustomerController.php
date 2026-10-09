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
use App\Models\UserRecord;
use App\Helpers\Log;

class CustomerController extends Controller
{
    public function index(){
        $data = User::with('userrecord')->where('is_role','0')->where('is_status','1')->latest()->get();
        //dd($data);
        return view('admin.customers.index', compact('data'))->with('i');
    }

    public function block(){
        $data = User::where('is_role','0')->where('is_status','0')->latest()->get();
        return view('admin.customers.block', compact('data'))->with('i');
    }
}
