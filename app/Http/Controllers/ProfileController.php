<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ProfileController extends Controller
{
    public function index(User $user): Response
    {
        return Inertia::render('Profile/Index', [
            'user' => new UserResource($user),
            'status' => session('status'),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
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

    // Update cover photo
    public function updateImages(Request $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate(
            [
                'cover' => 'image|nullable',
                'avatar' => 'image|nullable'
            ]
        );

        // Get image files
        $cover = $request->file('cover') ?? null;
        $avatar = $request->file('avatar') ?? null;

        if ($cover) {
            if (!is_null($user->cover_path)) {
                Storage::disk('public')->delete($user->cover_path);
            }

            // Replace new image and save
            $path = $request->file('cover')->store('photos/' . $user->id, 'public');
            $user->update(['cover_path' => $path]);
        }

        if ($avatar) {
            if (!is_null($user->avatar_path)) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            // Replace new image and save
            $path = $request->file('avatar')->store('photos/' . $user->id, 'public');
            $user->update(['avatar_path' => $path]);
        }

        return back()->with('status', 'Image updated successfully!');
    }
}
