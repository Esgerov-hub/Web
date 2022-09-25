<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use App\Models\NotificationsUsers;
use App\Models\Products;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class NotificationsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:notifications-view|notifications-create|notifications-edit|notifications-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:notifications-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:notifications-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:notifications-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $notifications = Notifications::select(
                [
                    'notifications.id',
                    'notifications.name',
                    'notifications.type',
                    'notifications.via',
                    'U.name_surname'
                ]
            )
                ->join('notifications_users as NU', 'notifications.id', '=', 'NU.notification_id')
                ->join('users as U', 'U.id', '=', 'NU.user_id')
                ->orderBy('notifications.id', 'desc')
                ->get();

            return view('dashboard.notifications.index', compact('notifications'));
        } catch (\Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
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
            $notification = null;
            $users = User::orderBy('id', 'DESC')->get();
            $products = Products::orderBy('id', 'DESC')->get();
            return view('dashboard.notifications.create_edit', compact('notification', 'users', 'products'));
        } catch (\Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function fetchUser(Request $request)
    {
        $type = $request->type;

        if ($type == 1) {
            $data['product'] = Products::select('id', 'name as name_surname')->orderBy("name", 'ASC')->get(["name", "id"]);
        } elseif ($type == 3) {
            $data['user'] = User::orderBy("name_surname", 'ASC')->get(["name_surname", "id"]);
        }

        return response()->json($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        try {
            $validator = Validator::make($request->all(), [
                'name_surname' => 'required|string|max:255|min:1',
                'value' => 'required|min:1',
                'type' => 'required|integer',
                'via' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            if ($request->type == 3) {
                $element_id = $request->user_id;
            } else {
                $element_id = $request->user_id;
            }
            $data = new Notifications();
            $data->name = $request->name_surname;
            $data->value = $request->value;
            if($request->type != 3){
            $data->element_id = $element_id;
             }
            $data->type = $request->type;
            $data->via = $request->via;
            $data->save();


            if ($request->type == 3) {
                $notification_user = new NotificationsUsers();
                $notification_user->notification_id = $data->id;
                $notification_user->user_id = $element_id;

                // dd($notification_user->user_id );

                $notification_user->save();
            }
            
            return redirect()->back()->with('success', 'Məlumatınız əlavə olundu!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function show(Notifications $notification)
    {
        try {

            $users = User::orderBy('id', 'DESC')->get();
            return view('dashboard.notifications.show', compact('notification', 'users'));
        } catch (\Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function edit(Notifications $notification)
    {
        try {
            $users = User::orderBy('id', 'DESC')->get();
            $products = Products::orderBy('id', 'DESC')->get();
            return view('dashboard.notifications.create_edit', compact('notification', 'users', 'products'));
        } catch (\Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notifications $notification)
    {
        // dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'name_surname' => 'required|string|max:255|min:1',
                'value' => 'required|min:1',
                'type' => 'required|integer',
                'via' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }


            $notification->name = $request->name_surname;
            $notification->value = $request->value;
            $notification->element_id = $request->element_id;
            $notification->type = $request->type;
            $notification->via = $request->via;
            $notification->save();

            NotificationsUsers::where('notification_id', $notification->id)->update(['user_id' => $request->user_id]);
            return redirect()->back()->with('success', 'Məlumatınız düzəliş olundu!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notifications $notification)
    {
        try {
            $notification = Notifications::where('id', $notification->id)->withTrashed()->first();
            if (isset($notification->deleted_at) && $notification->deleted_at != null) {

                // View
                $notification->forceDelete();
            } else {

                $notification->delete();
            }

            return redirect()->back()->with('success', 'Məlumatınız ləvğ edildi.');
        } catch (\Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }


    public function recycle()
    {
        try {
            $notifications = Notifications::select(
                [
                    'notifications.id',
                    'notifications.name',
                    'notifications.type',
                    'notifications.via',
                    'U.name_surname'
                ]
            )
                ->join('notifications_users as NU', 'notifications.id', '=', 'NU.notification_id')
                ->join('users as U', 'U.id', '=', 'NU.user_id')
                ->orderBy('notifications.id', 'desc')->onlyTrashed()->get();

            return view('dashboard.notifications.recycle', compact('notifications'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function restore(Notifications $notification, $id)
    {
        try {
            $notification = Notifications::where('id', $id)->withTrashed()->restore();

            return redirect()->back()->with('success', 'Məlumatınız geri qaytarıldı.');
        } catch (\Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
