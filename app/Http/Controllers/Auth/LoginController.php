<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Where to redirect users after login (dynamic based on role).
     */
    protected function redirectTo()
    {
        $user = Auth::user();
        
        if ($user && $user->role === 'admin') {
            return route('admin.dashboardadmin');
        }
        
        return route('user.dashboarduser');
    }
}