<?php

namespace App\Http\Controllers;

use App\Helper\fileUpload;
use App\Helper\mHelper;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
//        $user = $request->user();
//        $user->fill($request->validated());
//        dd($user);
//        $user->save();

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $data = User::where('id',$request->user()->id)->get();
        $photo = fileUpload::changeUpload($request->user()->id,'user',$request->file('photo'),0,$data,'photo');
        $request->user()->photo = $photo;
        $request->user()->save();

        return Redirect::route('index')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
