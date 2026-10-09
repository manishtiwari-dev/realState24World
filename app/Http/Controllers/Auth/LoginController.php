<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Helpers\Log;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/dashboard';

    /** Custom Login Code */

    // public function login(Request $request)
    // {
    //     $validated = $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);
    //     $user = User::where('email', $validated['email'])->first();
    //     if($user && $user->is_status == 1) {
    //         if ($user->is_role == 1) {
    //             if (Auth::attempt($validated)) {
    //                 $request->session()->regenerate();
    //                 //return redirect()->route('admin.home');
    //                 //=====logs=====
    //                 $logInstance = new Log();
    //                 $logInstance->addToLog('Login', 'User Logged In', 'Login', $request->all());
    //                 //=====logs=====
    //                 return redirect()->route('admin.2fa');
    //             }
    //             return redirect()->route('login')->with('error', 'Invalid login credentials. Please try again.');
    //         } 
    //         return redirect()->route('login')->with('error', 'Access denied. You do not have administrative privileges.');
    //     } else {
    //         return redirect()->route('login')->with('error', 'Account deactivated, please contact the administrator.');
    //     }
    // }


    public function showAgentLoginForm()
    {
        return view('auth.agentlogin');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login');
    }

    public function showDealerLoginForm()
    {
        return view('auth.dealerlogin');
    }


    public function login(Request $request)
    {

        // dd($request->all());
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $user = User::where('email', $validated['email'])->first();
        if (!$user) {
            return back()->with('error', 'Invalid credentials.');
        }

        if ($user->is_status != 1) {
            return back()->with('error', 'Account deactivated, please contact the administrator.');
        }



        $currentUrl = $request->path();
        $isAgentPanel = str_contains($currentUrl, 'agentpanel');
        $isDealerPanel = str_contains($currentUrl, 'dealerpanel');

        // Determine role and guard
        $role = $user->is_role;
        $guard = match ($role) {
            1 => 'web',
            2 => 'agent',
            3 => 'dealer',
            0 => 'web'
        };

        if ($isAgentPanel && $role != 2) {
            return back()->with('error', 'Invalid credentials.');
        }

        if ($isDealerPanel && $role != 3) {
            return back()->with('error', 'Invalid credentials.');
        }


           // dd($role);

        if (!$guard) {
            return back()->with('error', 'Invalid user role.');
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return back()->with('error', 'Incorrect password.');
        }
        // Attempt login with the correct guard
        if (Auth::guard($guard)->attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ])) {

           // dd($guard);
            $request->session()->regenerate();
            session(['guard' => $guard]);

            // =====logs=====
            $logInstance = new Log();
            $logInstance->addToLog('Login', 'User Logged In', 'Login', $request->all());
            ///=====logs=====

            // Redirect based on role
            //dd($role);
            return match ($role) {
                0 => redirect()->route('admin.2fa'),
                1 => redirect()->route('admin.2fa'),
                2 => redirect()->route('agent.2fa'),
                3 => redirect()->route('dealer.2fa'),
            };
        }

        return back()->with('error', 'Invalid login credentials. Please try again.');
    }


    public function logout(Request $request)
    {
        $guard = session('guard') ?? 'web';

        $redirectRoute = match ($guard) {
            'web' => 'admin.login',
            'agent' => 'agent.login',
            'dealer' => 'dealer.login',
            default => 'login'
        };

        // Logout from guard
        Auth::guard($guard)->logout();

        // Invalidate the session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($redirectRoute);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
