<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PermissionLabel;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:roles-view|roles-create|roles-edit|roles-delete', ['only' => ['index','show']]);
        $this->middleware('permission:roles-create', ['only' => ['create','store']]);
        $this->middleware('permission:roles-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:roles-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $roles = Role::all();
            return view('dashboard.roles.index',['roles'=>$roles]);
        }catch (\Throwable $exception){
            return redirect()->back()->with('fail',$exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $permissions = PermissionLabel::with('permissions')->get();
//            dd($permissions);
            return view('dashboard.roles.create',['permissions' => $permissions]);
        }catch (\Throwable $exception){
            return redirect()->back()->with('fail',$exception->getMessage());
        }
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
            'role'=>'required',
            'permissions' => 'required'
        ]);

        try {

            $role = Role::create([
                'name' => $request->role,
                'guard_name' => 'web',
            ]);


            $role->syncPermissions($request->permissions);
            DB::commit();
            return redirect()->back()->with('success','Məlumat əlavə olundu.');

        }catch (\Throwable $exception){
            DB::rollBack();
            return redirect()->back()->with('fail',$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        try{
            $permissions = PermissionLabel::with('permissions')->get();

            $permissionsSelected = $role->permissions()->get();


            $data = [];
            foreach ($permissionsSelected as $permission){
                $data[] = $permission->name;
            }

            return view('dashboard.roles.edit',['role' => $role,'permissions' => $permissions,'selectedPermissions' => $data]);

        }catch (\Throwable $exception){
            return redirect()->back()->with('fail',$exception->getMessage());
        }    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'required'
        ]);

//        try {
            if(empty($request->permissions)){
                return redirect()->back()->with('fail','Check your role permissions.');
            }
//            dd($request->all());
            $role = Role::where(['id' => $role->id])->first();
//            dd($role);
            $role->syncPermissions($request['permissions']);
//            dd($role);
            DB::commit();
            return redirect()->back()->with('success','Məlumat yeniləndi.');

//        }catch (\Throwable $exception){
//            DB::rollBack();
//            return redirect()->back()->with('fail',$exception->getMessage());
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
