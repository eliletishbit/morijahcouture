<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    // Liste paginée des utilisateurs
    public function index()
    {
        $users = User::orderBy('name')->paginate(15);
        return view('pages.backend.utilisateurs.index', compact('users'));
    }

    // Formulaire création
    public function create()
    {
        return view('pages.backend.utilisateurs.create');
    }

    // Enregistrement nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'status' => 'required|in:active,inactive',
        ]);

        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_picture' => $profilePicturePath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    // Affichage utilisateur
    public function show(User $user)
    {
        return view('pages.backend.utilisateurs.show', compact('user'));
    }

    // Formulaire édition utilisateur
    public function edit(User $user)
    {
        return view('pages.backend.utilisateurs.edit', compact('user'));
    }

    // Mise à jour utilisateur
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'status' => 'required|in:active,inactive',
        ];

        // Le mot de passe est optionnel à la mise à jour
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Rules\Password::defaults()];
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicturePath;
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->status = $validated['status'];

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // Suppression utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé.');
    }
}
