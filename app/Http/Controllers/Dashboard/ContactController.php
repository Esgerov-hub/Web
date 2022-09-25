<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{

function __construct()
    {
        $this->middleware('permission:contacts-view|contacts-create|contacts-edit|contacts-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:contacts-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:contacts-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:contacts-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        try {
            $contacts = ContactUs::orderBy('id','desc')->get();
//            dd($contacts);
            return view('dashboard.contacts.index',compact('contacts'));
        }catch (\Throwable $exception)
        {
            return redirect()->back()->with('errors',$exception->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $datas = ContactUs::with('users')->find($id);

            $data =
                [
                    'id' => $datas->id,
                    'namesurname' => $datas->namesurname,
                    'phone' => $datas->phone,
                    'email' => $datas->email,
                    'subject' => $datas->subject,
                    'message' => $datas->message,
                    'user_id' => $datas->users->name_surname,
                    'ipaddress' => $datas->ipaddress,
                    'created_at' => $datas->created_at->format('d.m.Y')
                ];

            return $data;
//            return response()->json($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
             ContactUs::where('id',$id)->delete();

            return redirect()->back()->with('success','Məlumatınız ləvğ edildi!');
        }catch (\Throwable $exception)
        {
            return redirect()->back()->with('errors',$exception->getMessage());
        }
    }

    public function recycle()
    {
        try{
            $contacts = ContactUs::orderBy('id','desc')->onlyTrashed()->get();

            return view('dashboard.contacts.recycle',compact('contacts'));

        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    public function restore(ContactUs $contact,$id)
    {
        try {
            $contacts = ContactUs::where('id',$id)->withTrashed()->restore();

            return redirect()->back()->with('success', 'Məlumatınız geri qaytarıldı.');
        }catch (\Throwable $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
