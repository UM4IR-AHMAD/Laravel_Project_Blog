<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Events\Registered;


use App\Models\Role;


class ProfileController extends Controller
{

    public function edit(){
        $data = auth()->user();
        // session()->flash('_old_input', $data);
        return view('profile', compact('data'));
    }

    //
    public function update(UpdateProfileRequest $request){
        // dd($request->input());

        auth()->user()->update($request->only('name', 'username'));
        
        return redirect()->route('profile.edit')->with(['message' => 'Updated Successfully']);
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = auth()->user();
        $user->email = $request->email;
        $user->email_verified_at = NULL;
        $user->save();

        // sending email
        event(new Registered($user));

        return back()->with('email-sent', 'yes')->with('message', 'Email adderss updated. Check email box for verification');
    }
}
