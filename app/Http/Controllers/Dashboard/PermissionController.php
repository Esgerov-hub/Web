<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionLabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function dd;
use function explode;
use function redirect;
use function route;
use function trim;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permissions-view|permissions-create|permissions-edit|permissions-delete', ['only' => ['index','show']]);
        $this->middleware('permission:permissions-create', ['only' => ['create','store']]);
        $this->middleware('permission:permissions-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permissions-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $permissions = Permission::orderBy('name')->get();

            return view('dashboard.permissions.index', compact('permissions'));
        } catch (\Throwable $exception) {
            return $exception->getMessage();
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

            return view('dashboard.permissions.create');
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ]);

        try {
            $label = $request->name;
            $checkLabelNameExistOrNot = PermissionLabel::where(['name' => $label])->first();

            if(!$checkLabelNameExistOrNot){
                $permissionLabel = PermissionLabel::create(['name' => $label]);
            }

            $permissions = explode(',',$request->permissions);

            foreach ($permissions as $permission){
                $permissionExist = Permission::where(['name' => trim($permission)])->first();
                if($permissionExist){
                    continue;
                }else {
                    Permission::create(['label_id' => $permissionLabel->id,'name' => $permission,'guard_name' => 'web']);
                }
            }

            DB::commit();
            return redirect()->back()->with('success','Məlumatınız əlavə edildi.');
        }catch (\Throwable $exception){
            DB::rollBack();
            return redirect()->back()->with('fail',$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
