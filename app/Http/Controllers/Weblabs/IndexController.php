<?php

namespace App\Http\Controllers\Weblabs;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Partners;
use App\Models\Project;
use App\Models\StandartPages;
use Illuminate\Http\Request;

class IndexController extends Controller
{
     public function index()
     {
         $sliders = StandartPages::where('type','slide')->orderBy('id','desc')->get();
//         dd($sliders);
         $services = StandartPages::where('type','service')->orderBy('id','desc')->get();
         $partners = Partners::all();
         $projects = Project::where('active',1)->orderBy('id','desc')->get();
        return view('weblabs.index',compact('services','partners','projects','sliders'));
     }


     public function about()
     {
         $data = StandartPages::where('type','about')->orderBy('id','desc')->get();
        return view('weblabs.about',compact('data'));
     }

     public function service()
     {
         $data = StandartPages::where('type','service')->orderBy('id','desc')->get();
        return view('weblabs.service',compact('data'));
     }

    public function service_details($id)
    {
        $data = StandartPages::where(['type' => 'service', 'id'=>$id])->first();
        $services = StandartPages::where('type','service')->orderBy('id','desc')->get();
        return view('weblabs.service_details',compact('data','services'));
    }


     public function team()
     {
        return view('weblabs.team');
     }


    public function project()
    {
        $data = Project::where('active',1)->orderBy('id','desc')->get();
        return view('weblabs.project',compact('data'));
    }


//     public function blog()
//     {
//        return view('weblabs.blog');
//     }
//    public function blog_details()
//    {
//        return view('weblabs.blog_details');
//    }

     public function contact()
     {
        return view('weblabs.contact');
     }

    public function contactPost(Request $request)
    {

        try {
            $request->validate([
                'namesurname' => 'string',
                'phone' => 'required',
                'email' => 'required',
                'subject' => 'required',
                'message' => 'required'
            ]);


            $contact = new ContactUs();
            $contact->ipaddress = $request->ip();
            $contact->namesurname = $request->namesurname;
            $contact->phone = $request->phone;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();

            if ($contact != null)
            {
                return $contact;
            }else{
                return $contact;
            }

        } catch (\Exception $e) {

            return false;
        }
    }
}
