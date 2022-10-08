<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PartnerRequest;
use App\Models\Attributes;
use App\Models\Partners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Nette\Utils\Image;

class PartnerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:partners-view|partners-create|partners-edit|partners-delete', ['only' => ['index','show']]);
        $this->middleware('permission:partners-create', ['only' => ['create','store']]);
        $this->middleware('permission:partners-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:partners-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partners::orderBy('id','desc')->get();

        return view('dashboard.partners.index',compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partner=null;
        return view('dashboard.partners.create_edit',compact('partner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
//        dd($request->all());
        try {
            $name =
                [
                'az_name' => $request->az_name,
                'en_name' => $request->en_name,
                'ru_name' => $request->ru_name,
            ];

            $imageurl=null;
            if($request->hasFile('image')) {
                $imageurl=Helper::image_upload($request->image,"partners");
            }

            $data = new Partners();
            $data->name = $name;
            $data->image = $imageurl;
            $data->status = $request->status;
            $data->url = $request->url;
            $data->order = $request->order;
            $data->save();

            return redirect()->back()->with('success', 'Məlumatınız əlavə edildi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partners  $partners
     * @return \Illuminate\Http\Response
     */
    public function show(Partners $partners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partners  $partners
     * @return \Illuminate\Http\Response
     */
    public function edit(Partners $partner)
    {
        try {
            return view('dashboard.partners.create_edit', compact('partner'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partners  $partners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partners $partner)
    {
        try {
            $validator = Validator::make($request->all(), [
                'az_name' => 'required|string|max:255|min:1',
                'ru_name' => 'required|string|max:255|min:1',
                'en_name' => 'required|string|max:255|min:1',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $imageurl=null;
            if(isset($partner->image) && $partner->image!=null){
                $imageurl=$partner->image;
            }

            if($request->hasFile('image')) {
//                if($imageurl!=null){
//                    Helper::delete_image($imageurl);
//                }
                $imageurl=Helper::image_upload($request->image,"partners");
            }


            Partners::where("id", $partner->id)->update([
                "name->az_name" => $request->az_name,
                "name->ru_name" => $request->ru_name,
                "name->en_name" => $request->en_name,
                "image" => $imageurl,
                "order" => $request->order,
                "url" => $request->url,
                "status" => $request->status,
            ]);

            return redirect(route("partners.index"))->with('info', 'Məlumatınız düzəliş edildi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partners  $partners
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partners $partner)
    {

        try {
//            $partner=Partners::where('id',$partner->id)->withTrashed()->first();
//            if(isset($partner->deleted_at) && $partner->deleted_at!=null){
//                if(isset($partner->image) && $partner->image!=null){
//                    Helper::delete_image($partner->image);
//                }
//                // View
//                $partner->forceDelete();
//            }else{
//                $partner->update([
//                    "status"=>false
//                ]);
                $partner->delete();
//            }
            return redirect()->back()->with('info', 'Məlumatınız ləvğ edildi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function recycle()
    {
        try{
            $partners = Partners::orderBy('id','desc')->onlyTrashed()->get();

            return view('dashboard.partners.recycle',compact('partners'));

        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    public function restore(Partners $partner,$id)
    {
        try {
            $partners = Partners::where('id',$id)->withTrashed()->restore();

            return redirect()->back()->with('success', 'Məlumatınız geri qaytarıldı.');
        }catch (\Throwable $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
