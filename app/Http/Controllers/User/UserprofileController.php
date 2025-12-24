<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserprofileController extends Controller
{
    //
    /**
     * Affiche le formulaire d'édition du profil
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        // Passe l'utilisateur à la vue Blade classique
        return view('auth.profile.edit', [
            'user' => $user,
            'mustVerifyEmail' => $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Met à jour les informations du profil utilisateur
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profil-modifie');
    }

    /**
     * Supprime le compte utilisateur
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show()
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Retourner la vue avec l'utilisateur
        return view('pages.frontend.profil.show', compact('user'));
    }
}
