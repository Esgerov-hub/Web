<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{

 function __construct()
    {
        $this->middleware('permission:attributes-view|attributes-create|attributes-edit|attributes-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:attributes-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:attributes-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:attributes-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $attributes = Attributes::orderBy("id", "DESC")->get();
            $groups=Attributes::where('type',1)->orderBy("created_at", "DESC")->get();
            return view('dashboard.attributes.index', ['data' => $attributes,'groups' => $groups]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $name = [
                'az_name' => $request->name['az_name'],
                'ru_name' => $request->name['ru_name'],
                'en_name' => $request->name['en_name'],
            ];

            $data= new Attributes();
            $data->name=$name;
            $data->type=$request->type;
            $data->status=$request->filter;
            $data->group_id=$request->group_id;
            $data->datatype=$request->datatype;
            $data->order=$request->order;
            $data->save();
            //  return true;
        } catch (\Exception $e) {
            return $e->getMessage();
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function show(Attributes $attribute)
    {
        try {
            $data = Attributes::find($attribute->id);
            return response()->json($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function getGroups()
    {
        try {
            $data = Attributes::where('type',1)->orderBy('created_at','DESC')->get();
            return response()->json($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attributes $attribute)
    {
        try {

            $name = [
                'az_name' => $request->name['az_name'],
                'ru_name' => $request->name['ru_name'],
                'en_name' => $request->name['en_name'],
            ];

            $attribute->name=$name;
            $attribute->type=$request->type;
            $attribute->status=$request->filter;
            $attribute->group_id=$request->group_id;
            $attribute->datatype=$request->datatype;
            $attribute->order=$request->order;
            $attribute->save();

            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attributes $attribute)
    {
        try {
            Attributes::where("id", $attribute->id)->delete();
            return redirect()->back()->with('success', 'Uğurlu');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function recycle()
    {
        try{
            $attributes = Attributes::orderBy('id','desc')->onlyTrashed()->get();
           
            return view('dashboard.attributes.recycle',compact('attributes'));

        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    public function restore(Attributes $attribute,$id)
    {
        try {
            $attributes = Attributes::where('id',$id)->withTrashed()->restore();

            return redirect()->back()->with('success', 'Məlumatınız geri qaytarıldı.');
        }catch (\Throwable $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }  
}
