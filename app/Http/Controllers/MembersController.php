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
        // $data = User::latest()->paginate(3);
        // $data = User::where('id', '!=', auth()->user()->id)->paginate(3);


        
        // print_r($u[0]['role']['role']);
        // foreach ($u as $value) {
        //     // echo($value . '<br>');
        //     $x = $value;
        // }

        //get user and role data
        /* $u = User::with('role')->where('role_id', auth()->user()->role_id)->get();
        $u = $u[0];
        echo($u->role->role); */

        // fetch role and user data 
        /* $u = Role::with('user')->where('role', 'super admin')->get();
        $u = $u[0];
        echo $u->user[0]->name;*/

        
        // $this->authorize('isSuperAdmin'); #it is use for denied only
         

        if (Gate::allows('isSuperAdmin', auth()->user())) {
         
            // $data = User::with('role')->where( 'role', '!=', 'super admin')->where('id', '!=', auth()->user()->id )->paginate(3);

            // $data = Role::find(auth()->user()->role_id); // dd($data->user); works. 
            // $data = Role::where('id', '!=' ,auth()->user()->role_id)->get(); // dd($data->user); don't works.
            

            /* one way of fetch user data according to role */

           /*// fetch data through role.
            // $records = Role::with('user')->where('role', '!=', 'super admin')->get(); // fetch the user data also 
            $records = Role::where('role', '!=', 'super admin')->get(); // not fetch but can if call same done by foreach;


            dd($records);
            $data = collect(); // create collection.
            
            // traversing collection to access role from user
            foreach ($records as $key => $roles) {
                foreach ($roles->user as $key => $user) 
                {                   
                    // fetch user data one by one 
                    $data -> push($user);
                } 
            }

            // applying custom pagintaion which in AppServiceProvider boo()
            $data = $data->paginate(2); */

            // The best way
            $data = User::whereRelation('role', 'role','!=', 'super admin')->paginate(8);
        }
        else{
             // $data = User::with('role')->where( 'role_id', 'normal')->paginate(3);
            // $data = Role::with('user')->where('role', 'normal')->paginate(1);

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
            // 'email' => 'required|email|unique:users',
            'username' => ['required', 'min:4', Rule::unique('users')->ignore($request->id)],
            'password' => 'required|confirmed|min:6',
            $roleValidation
        ]);
    }

   /*  public function create(){
        $roles = Role::select('id', 'role')->get()->toArray();  
        return view('auth.register', compact('roles'));
    }

    public function insert(Request $request){

        $this->validation($request);
        $role_id = '';
        
        // only super admin can set the role
        if(Gate::denies('isSuperAdmin', auth()->user())){
            $role_id = self::AUTHOR;
        }
        else{
            $role_id =  $request->role_id;
        }

        $insert = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role_id' => $role_id,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('members')->with('message','New user '.$request->name.' added');
    }
 */
    
    public function edit($id, Request $request){
        $data = User::find($id);

        // store until session destried
        // Session::set('_old_input.key', Input::get('value')); // store value
        // $request->session()->put('_old_input', $data[0]); // store array
        // session(['_old_input.key' => 'value']); //global helper

        // put data into input;
        /* $request->request->add(['data'=> $data]);
        dd($request->input()); */

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
