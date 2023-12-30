<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;




class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $admin_data = User::find($id);
        return view('admin.admin_profile',compact('admin_data'));
    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $admin_data = User::find($id);

        $admin_data->name = $request->name;
        $admin_data->email = $request->email;
        $admin_data->phone = $request->phone;
        $admin_data->address = $request->address;
        
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('AdminBackend/upload/admin_image/'.$admin_data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('AdminBackend/upload/admin_image/'),$filename);
            $admin_data['photo'] = $filename;
        }

        $admin_data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, auth::user()->password)){
            return back()->with('error', "Old Password Doesn't Match");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', "Password Change Successfully");

    } 
    
    
    public function AllAdmin(){
        $alladminuser = User::where('role','admin')->latest()->get();
        return view('admin.all_admin',compact('alladminuser'));
    }// End Mehtod 

    public function AddAdmin(){
        $roles = Role::all();
        return view('admin.add_admin',compact('roles'));
    }// End Mehtod 

    public function AdminUserStore(Request $request){

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->roles) {

            $data = array();
            $data['role_id'] = $request->roles;
            $data['model_type'] = 'App\Models\User';
            $data['model_id'] = $user->id; 

            DB::table('model_has_roles')->insert($data);
            //$user->assignRole($request->roles);
        }

         $notification = array(
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect('/all/admin')->with($notification);

    }// End Mehtod 

    public function EditAdminRole($id){

        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.edit_admin',compact('user','roles'));
    }// End Mehtod 

    public function AdminUserUpdate(Request $request,$id){


        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address; 
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        //$user->roles()->detach();
        if ($request->roles) {
            DB::table('model_has_roles')->where('model_id', $id)->update(['role_id' => $request->roles]);
            //$user->assignRole($request->roles);
        }

         $notification = array(
            'message' => 'New Admin User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);

    }// End Mehtod 


    public function DeleteAdminRole($id){

      
         User::where('id', $id)->delete();
         DB::table('model_has_roles')->where('model_id', $id)->delete();


         $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Mehtod 





}
