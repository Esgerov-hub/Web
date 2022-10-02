<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Str;
use Nette\Utils\Image;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:users-view|users-create|users-edit|users-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:users-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:users-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::orderBy('name_surname')->get();

            return view('dashboard.users.index', compact('users'));
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function delete()
    {
        $users = User::orderBy('name_surname')->onlyTrashed()->get();

        return view('dashboard.delete.users', compact('users'));
    }

    public function restore(User $user, $id)
    {
        try {
            $users = User::where('id', $id)->withTrashed()->restore();

            return redirect()->back()->with('success', 'Məlumatınız geri qaytarıldı.');
        } catch (\Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()]);
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
            $roles = Role::pluck('name', 'name')->all();
            $user = null;
            return view('dashboard.users.create_edit', compact('roles', 'user'));
        } catch (\Throwable $exception) {
            return redirect()->back()->with('fail', $exception->getMessage());
        }
    }


    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        try {
            $imageurl = null;
            if ($request->hasFile('photo')) {
                $imageurl = Helper::image_upload($request->photo, "users");
            }

            $user = new User();
            $user->photo = $imageurl;
            $user->name_surname = $request->name_surname;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->type = $request->type;
            $user->referal_code = self::unique_code(50);
            $user->save();
            $user->assignRole($request->roles);

            return redirect()->back()->with('success', 'Məlumatınız əlavə edildi.');
        } catch (\Throwable $exception) {
            return redirect()->back()->with('success', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // dd($user->notificationsUsers);
        try {
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->first();

            return view('dashboard.users.show', compact('user', 'roles', 'userRole'));
        } catch (\Throwable $exception) {
            return redirect()->back()->with('fail', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        try {
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->first();

            return view('dashboard.users.create_edit', compact('user', 'roles', 'userRole'));
        } catch (\Throwable $exception) {
            return redirect()->back()->with('fail', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name_surname' => 'required|string',
            'phone' => 'required|size:10',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
            'type' => 'required|integer',
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }

        try {

            $imageurl = null;
            if (isset($user->photo) && $user->photo != null) {
                $imageurl = $user->photo;
            }

            if ($request->hasFile('photo')) {
                if ($imageurl != null) {
                    Helper::delete_image($imageurl);
                }
                $imageurl = Helper::image_upload($request->photo, "users");
            }


            $user->photo = $imageurl;
            $user->name_surname = $request->name_surname;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->referal_code = self::unique_code(50);
            $user->type = $request->type;
            $user->save();
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            $user->assignRole($request->roles);

            return redirect()->back()->with('success', 'Məlumatınız əlavə edildi.');
        } catch (\Throwable $exception) {
            return redirect()->back()->with('fail', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        try {
            if ($user->type != 1) {
                $user = User::where('id', $user->id)->withTrashed()->first();
                if (isset($user->deleted_at) && $user->deleted_at != null) {
                    if (isset($user->image) && $user->image != null) {
                        Helper::delete_image($user->image);
                    }
                    // View
                    $user->forceDelete();
                } else {
                    $user->update([
                        "status" => false
                    ]);
                    $user->delete();
                }

                return redirect()->back()->with('success', 'Məlumatınız ləvğ edildi.');
            } else {
                return redirect()->back()->with('success', 'Admin olduğunuz üçün məlumatınız ləvğ edimədi.');
            }
        } catch (\Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
