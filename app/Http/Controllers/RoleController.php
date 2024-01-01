<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\RoleHasPermission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;

class RoleController extends Controller
{
    public function AllPermission(){

        $permissions = Permission::all();
        return view('admin.role.all_permission',compact('permissions'));

    } // End Method 

    public function AddPermission(){
        return view('admin.role.add_permission');
    }// End Method 

    public function StorePermission(Request $request){

        $role = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        $notification = array(
            'message' => 'Permission Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification); 

    }// End Method 

    public function EditPermission($id){

        $permission = Permission::findOrFail($id);
        return view('admin.role.edit_permission',compact('permission'));
 
     }// End Method 
 
 
 
     public function UpdatePermission(Request $request){
         $per_id = $request->id;
 
 
          Permission::findOrFail($per_id)->update([
             'name' => $request->name,
             'group_name' => $request->group_name,
 
         ]);
 
         $notification = array(
             'message' => 'Permission Updated Successfully',
             'alert-type' => 'success'
         );
 
         return redirect()->route('all.permission')->with($notification); 
 
 
     }// End Method 
 
 
     public function DeletePermission($id){
 
          Permission::findOrFail($id)->delete();
 
          $notification = array(
             'message' => 'Permission Deleted Successfully',
             'alert-type' => 'success'
         );
 
         return redirect()->back()->with($notification); 
     }// End Method 


     public function AllRoles(){

        $roles = Role::orderBy('name', 'ASC')->get();
        return view('admin.role.all_roles',compact('roles'));

    } // End Method 



    public function AddRoles(){
        return view('admin.role.add_roles');
    }// End Method 


    public function StoreRoles(Request $request){

        $checking_role = Role::where('name', $request->name)->first();

        
        
        if($checking_role){
            $notification = array(
                'message' => 'This Roles has already defined',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $role = Role::create([
            'name' => $request->name, 

        ]);

      

        $notification = array(
            'message' => 'Roles Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification); 


    }// End Method 

    public function EditRoles($id){
        $roles = Role::findOrFail($id);
        return view('admin.role.edit_roles',compact('roles'));
    }// End Method 


    public function UpdateRoles(Request $request){

        $role_id = $request->id; 

        Role::findOrFail($role_id)->update([
            'name' => $request->name, 

        ]);

        $notification = array(
            'message' => 'Roles Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification); 

    }// End Method 

    public function DeleteRoles($id){

        Role::findOrFail($id)->delete();
          $notification = array(
               'message' => 'Roles Deleted Successfully',
               'alert-type' => 'success'
           );
   
           return redirect()->back()->with($notification); 
    }// End Method 


    public function AddRolesPermission(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('admin.role.add_roles_permission',compact('roles','permissions','permission_groups'));
   }// End Method 


   public function RolePermissionStore(Request $request){

    $data = array();
    $permissions = $request->permission;

    foreach($permissions as $key => $item){
        $data['role_id'] = $request->role_id;
        $data['permission_id'] = $item;

        DB::table('role_has_permissions')->insert($data);
    }

    

    /*
    $data = array();
    //$permissions = $request->permission;
    $permissions = $request->input('permission', []);

    foreach($permissions as $key => $item){
        $data['role_id'] = $request->role_id;
        $data['permission_id'] = $item;
        $user_id = Auth::user()->id;

        DB::table('role_has_permissions')->insert($data);
        //
        DB::table('model_has_permissions')->insert([
            'permission_id' => $data['permission_id'],
            'model_type' => 'App\Models\User',
            'model_id' => $user_id
        ]);
        //
    }  */

     $notification = array(
        'message' => 'Role Permission Added Successfully',
        'alert-type' => 'success'
    );

    return redirect('/all/roles/permission')->with($notification); 

   }

   public function AllRolesPermission(){

        $roles = Role::all();
     
        return view('admin.role.all_roles_permission',compact('roles'));

    } // End Method 


    public function AdminRolesEdit($id){

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('admin.role.role_permission_edit',compact('role','permissions','permission_groups'));
    } // End Method 


    public function AdminRolesUpdate(Request $request,$id){

        
        $role = Role::findOrFail($id);


        $permissions = $request->permission ;

        if (!empty($permissions)) {
            $permissions = array_map('intval', $permissions);
            $role->syncPermissions($permissions);
        }

        /*
        $permissions = $request->input('permission', []);
        $user_id = Auth::user()->id;
        $delete_data = DB::table('role_has_permissions')->where('role_id', $role->id)->delete();
        $delete_data = DB::table('model_has_permissions')->where('model_id', $user_id)->delete();
        $data = array();
        
        foreach($permissions as $item){
            $data['permission_id'] = $item;
            $data['role_id'] = $role->id;

            DB::table('role_has_permissions')->insert($data); 
    
            DB::table('model_has_permissions')->insert([
                'permission_id' => $data['permission_id'],
                'model_type' => 'App\Models\User',
                'model_id' => $user_id
            ]);

        

        }   */


         $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

    

        

        return redirect('/all/roles/permission')->with($notification); 

    }// End Method 


    public function AdminRolesDelete($id){

        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }

         $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 


   





}