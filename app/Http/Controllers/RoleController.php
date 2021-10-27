<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::orderBy('name', 'Asc')->get();
        $roles = Role::orderBy('name', 'Asc')->get();

        return view('backend.role.index', compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('backend.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required',
            'permissions' => 'required|array|min:1'
        ], [
            'permissions.required' => 'Give at least one Permission'
        ]);
        $role = Role::create(['name' => $request->role_name]);
        $role->syncpermissions($request->permissions);
        return back()->with('success', 'Role Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::where('id',$id)->first();
        return view('backend.role.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('backend.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'required|array|min:1'
        ], [
            'permissions.required' => 'Give at least one Permission'
        ]);
        $role->syncPermissions($request->permissions);
        return back()->with('success', 'Permissions Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function viewRole(){
        
        $order = Permission::where('name','category create')->first();
        if(empty($order)){
        $permission = Permission::create(['name' => 'category create']);
        $permission = Permission::create(['name' => 'category view']);
        $permission = Permission::create(['name' => 'category edit']);
        $permission = Permission::create(['name' => 'category delete']);
        $permission = Permission::create(['name' => 'category trash']);
        
        $permission = Permission::create(['name' => 'brand create']);
        $permission = Permission::create(['name' => 'brand view']);
        $permission = Permission::create(['name' => 'brand edit']);
        $permission = Permission::create(['name' => 'brand delete']);
        $permission = Permission::create(['name' => 'brand trash']);
        
        $permission = Permission::create(['name' => 'color create']);
        $permission = Permission::create(['name' => 'color view']);
        $permission = Permission::create(['name' => 'color edit']);
        $permission = Permission::create(['name' => 'color delete']);
        $permission = Permission::create(['name' => 'color trash']);
        
        $permission = Permission::create(['name' => 'attribute create']);
        $permission = Permission::create(['name' => 'attribute view']);
        $permission = Permission::create(['name' => 'attribute edit']);
        $permission = Permission::create(['name' => 'attribute delete']);
        $permission = Permission::create(['name' => 'attribute trash']);  
        
        $permission = Permission::create(['name' => 'gallery create']);
        $permission = Permission::create(['name' => 'gallery view']);
        $permission = Permission::create(['name' => 'gallery edit']);
        $permission = Permission::create(['name' => 'gallery delete']);
        $permission = Permission::create(['name' => 'gallery trash']);  
        
        $permission = Permission::create(['name' => 'coupon create']);
        $permission = Permission::create(['name' => 'coupon view']);
        $permission = Permission::create(['name' => 'coupon edit']);
        $permission = Permission::create(['name' => 'coupon delete']);
        $permission = Permission::create(['name' => 'coupon trash']); 
        
        $permission = Permission::create(['name' => 'product create']);
        $permission = Permission::create(['name' => 'product view']);
        $permission = Permission::create(['name' => 'product edit']);
        $permission = Permission::create(['name' => 'product delete']);
        $permission = Permission::create(['name' => 'product trash']);  
        
        Permission::create(['name' => 'assign user']);
        Permission::create(['name' => 'customer dashboard access']);
        
        // $super_admin = Role::where('name', 'Super Admin')->first();
        // $super_admin->givepermissionto(Permission::all());
        // $user = User::find(Auth::id());
        // $user->assignrole('Super Admin');
        }
        $roles = Role::orderBy('name', 'Asc')->get();

        return view('backend.role.view_role', compact('roles'));
    }

    public function assignUser()
    {

        return view('backend.role.assignuser', [
            "roles" => Role::all(),
            "users" => User::all(),
            // "userwithRole" => User::role(['Super Admin', 'Admin'])->get(),
        ]);
    }
    public function assignUserStore(Request $request)
    {
        $request->validate([
            "user" => "required",
            "role" => "required"
        ]);

        $user = User::find($request->user);
        $user->assignRole($request->role);
        return back()->with('success', 'Role Added Successfully');
    }
}
