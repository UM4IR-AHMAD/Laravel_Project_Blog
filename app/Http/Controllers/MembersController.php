<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;

use App\Models\User;
use App\Models\Role;

// for pagination
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
// use Illuminate\Support\Collection;




class MembersController extends Controller
{
    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const AUTHOR = 3;
    //
    public function show(){
       

        if (Gate::allows('isSuperAdmin', auth()->user())) {

            $data = User::whereRelation('role', 'role','!=', 'super admin')->paginate(8);
        }
        else{

            /* second way of fetch user data according to role.*/
            $data = User::with('role')->where('role_id',  self::AUTHOR)->paginate(8);
        }

        return view('member.members',['data'=> $data]);
    }



    public function search(Request $request){

        if (Gate::denies('isSuperAdmin', auth()->user())) {
            $data = User::where('name','LIKE', $request->search.'%')->where( 'role_id', self::AUTHOR)->paginate(2);
        }
        else{
            $data = User::where('name','LIKE', $request->search.'%')->where( 'role_id', '!=', self::SUPER_ADMIN)->paginate(2);
        }
        return view('member.members', ['data'=>$data]);
    }


    public function validation($request){

        $roleValidation = '';

        // only super admin can set the role
        if(Gate::denies('isSuperAdmin', auth()->user())){
            $roleValidation = '';
        }
        else{
            $roleValidation =  "'role_id' => 'required'";            
        }

        $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:4', Rule::unique('users')->ignore($request->id)],
            'password' => 'required|confirmed|min:6',
            $roleValidation
        ]);
    }

   
    
    public function edit($id, Request $request){
        $data = User::find($id);

       
        // store for only one request
        session()->flash('_old_input', $data);

        if(Gate::allows('isSuperAdmin', auth()->user())){
            $roles = Role::select('id', 'role')->get()->toArray();  
            return view('member.updateMember', compact('roles'));        
        }
        return view('member.updateMember');              
    }

    public function update(Request $request){

        $role_id = self::AUTHOR;
        $roleValidation = '';
        $passwordValidation = '';
        $password = '';

        // only super admin can set the role
        if(Gate::allows('isSuperAdmin', auth()->user())){
            $role_id =  $request->role_id;
            $roleValidation =  "'role_id' => 'required'";    
        }


        if (!empty($request->password)) {
            $roleValidation =  "'password' => 'required|confirmed|min:6'";            
        }

        $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:4', Rule::unique('users')->ignore($request->id)],
            $passwordValidation,
            $roleValidation,
        ]);
    

        // updation
        $user = User::find($request->id);
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->role_id = $role_id;
        (!empty($request->password)) ? $user->password = Hash::make( $request->input('password') ) :'';
        $user->save();    


        return back()->with('message', ' information has updated successfully');
    }

    public function updateEmail(Request $request)
    {
        $validate =  $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = User::find($request->id);
        $user->email = $request->email;
        $user->email_verified_at = NULL;
        $user->save();
        
        // sending email
        event(new Registered($user));

        return back()->with('email-sent', 'yes')->with('message', 'Email adderss updated. Check email box for verification');
    }


    public function delete($id){
        
        $posts = User::find($id)->post;
        foreach ($posts as $value) {
            $value->user_id = auth()->user()->id;
            $value->save();
        }
        $user = User::where('id', $id)->delete();
        return redirect()->route('members')->with('message', 'Author has removed and his posts are added to your posts');
    }
  
}
