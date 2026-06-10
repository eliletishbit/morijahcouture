<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5048'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        $profilePicturePath = null;

        if (request()->hasFile('profile_picture')) {
            $profilePicturePath = request()->file('profile_picture')->store('profile_pictures', 'public');
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_picture' => $profilePicturePath,
            'role' => 'user',
        ]);
    }

    /**
     * Where to redirect users after registration (dynamic based on role).
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