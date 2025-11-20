<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        // TODO: Select columns
        $users = User::all();

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        // Create the user
        $user = User::create($request->all());

        // Handle upload an image
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            // Ensure the storage directory exists
            Storage::makeDirectory('public/profile');

            // Store the image
            $file->storeAs('public/profile', $filename);

            // Update the user's photo attribute
            $user->update(['photo' => $filename]);
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'New User has been created!');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        // Update the user
        $user->update($request->except('photo'));

        // Handle upload image with Storage
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($user->photo) {
                Storage::delete('public/profile/' . $user->photo);
            }

            // Prepare new photo
            $file = $request->file('photo');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            // Store the new image
            $file->storeAs('public/profile', $fileName);

            // Update the user's photo attribute
            $user->update(['photo' => $fileName]);
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'User has been updated!');
    }
    public function updatePassword(Request $request, String $username)
    {
        # Validation
        $validated = $request->validate([
            'password' => 'required_with:password_confirmation|min:6',
            'password_confirmation' => 'same:password|min:6',
        ]);

        # Update the new Password
        User::where('username', $username)->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User has been updated!');
    }

    public function destroy(User $user)
    {
        /**
         * Delete photo if exists.
         */
        if($user->photo){
            unlink(public_path('storage/profile/') . $user->photo);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User has been deleted!');
    }
}
