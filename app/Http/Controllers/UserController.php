<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\MatchOldPassword;
use App\Rules\DifferentPassword;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.user.index',[
            'users' => User::all()
        ]);
    }
    public function create()
    {
        return view('pages.user.create');
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('user.index')->with('successct', 'User created successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('successdt', 'User deleted successfully!');
    }

    public function changePassword(User $user)
    {
        $user = auth()->user();
        return view('pages.user.changepassword', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'current-password' => ['required', new MatchOldPassword],
            'new-password' => ['required', 'string', 'min:8', 'confirmed', new DifferentPassword],
        ],[
            'current-password.required' => 'The current password field is required.',
            'new-password.required' => 'The new password field is required.',
            'new-password.different' => 'The new password and current password cannot be the same.',
            'new-password.confirmed' => 'The new password confirmation does not match.',
        ]);

        $user = User::find(auth()->user()->id);
        $user->update(['password'=> Hash::make($request->input('new-password'))]);

        Auth::logout();
        return redirect()->route('login')->with('success', 'Password changed successfully! Please login with your new password.'); 
    }


    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        
        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('user.index')->with('successup', 'User updated successfully!');
    }
}