<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('admin.profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'birthdate' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
            'address' => ['nullable', 'string'],
            'bio' => ['nullable', 'string'],
        ]);

        $user->fill($validated);
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Profil mis à jour avec succès.');
    }

    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => ['required', 'image', 'max:2048'], // 2MB max
        ]);

        $user = Auth::user();

        // Delete old photo if exists
        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        // Store new photo
        $path = $request->file('profile_photo')->store('profile-photos', 'public');
        
        // Enregistrer le chemin dans la base de données
        $user->profile_photo = $path;
        $user->save();

        // Vider le cache pour s'assurer que la nouvelle image est affichée
        Cache::forget('user_' . $user->id . '_profile_image');

        return redirect()->route('profile.edit')->with('status', 'Photo de profil mise à jour avec succès.');
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Mot de passe mis à jour avec succès.');
    }

    /**
     * Update the user's fitness information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateFitness(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'height' => ['nullable', 'numeric', 'min:50', 'max:250'],
            'weight' => ['nullable', 'numeric', 'min:30', 'max:300'],
            'fitness_goal' => ['nullable', 'string', 'in:weight_loss,muscle_gain,endurance,flexibility,general_fitness'],
            'activity_level' => ['nullable', 'string', 'in:sedentary,light,moderate,active,extreme'],
            'preferred_activities' => ['nullable', 'array'],
            'medical_conditions' => ['nullable', 'string'],
            'dietary_restrictions' => ['nullable', 'string'],
        ]);

        if (isset($validated['preferred_activities'])) {
            $validated['preferred_activities'] = implode(',', $validated['preferred_activities']);
        }

        $user->fill($validated);
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Données fitness mises à jour avec succès.');
    }

    /**
     * Update the user's preferences.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePreferences(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'email_notifications' => ['nullable', 'boolean'],
            'push_notifications' => ['nullable', 'boolean'],
            'workout_reminders' => ['nullable', 'boolean'],
            'achievement_notifications' => ['nullable', 'boolean'],
            'newsletter' => ['nullable', 'boolean'],
            'theme' => ['nullable', 'string', 'in:light,dark,system'],
            'language' => ['nullable', 'string', 'in:fr,en,es,de'],
            'units' => ['nullable', 'string', 'in:metric,imperial'],
        ]);

        // Convert checkbox values to boolean
        foreach (['email_notifications', 'push_notifications', 'workout_reminders', 'achievement_notifications', 'newsletter'] as $field) {
            $validated[$field] = isset($validated[$field]) ? 1 : 0;
        }

        $user->fill($validated);
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Préférences mises à jour avec succès.');
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}