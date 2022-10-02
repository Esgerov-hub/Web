<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\MetaSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:categories-view|categories-create|categories-edit|categories-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:categories-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:categories-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:categories-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories = Categories::orderBy("id", "DESC")->get();
            return view('dashboard.categories.index', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
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
            $categories = Categories::orderBy("id", "DESC")->get();
            $category = null;
            return view('dashboard.categories.create_edit', compact('categories','category'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('errors', $e->getMessage());
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
        try {
            $validator = Validator::make($request->all(), [
                'az_name' => 'required|string|max:255|min:1',
                'ru_name' => 'required|string|max:255|min:1',
                'en_name' => 'required|string|max:255|min:1',
                'image' => 'image|mimes:jpg,jpeg,pjpeg,pjp,avif,jfif,bmp,ico,cur,png,gif,svg,webp,tif,tiff',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $name = [
                'az_name' => $request->az_name,
                'ru_name' => $request->ru_name,
                'en_name' => $request->en_name,
            ];

            $description = [
                'az_description' => $request->az_description,
                'ru_description' => $request->ru_description,
                'en_description' => $request->en_description,
            ];



            $imageurl=null;
            if($request->hasFile('image')) {
                $imageurl=Helper::image_upload($request->image,"categories");
            }


//            dd($imageurl);
            $data = new Categories();
            $data->name = $name;
            $data->description = $description;
            $data->image = $imageurl;
            $data->active = $request->active;
            $data->save();

//            dd('ss');

            return redirect()->back()->with('success', 'Məlumatınız əlavə olundu!');
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $category)
    {
        try {
            $category = Categories::where("id", $category->id)->with('seo')->first();
            $categories = Categories::orderBy("id", "DESC")->get();
            return view('dashboard.categories.create_edit', compact('category','categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $category)
    {
        try {
            $validator = Validator::make($request->all(), [
                'az_name' => 'required|string|max:255|min:1',
                'ru_name' => 'required|string|max:255|min:1',
                'en_name' => 'required|string|max:255|min:1',
                'image' => 'image|mimes:jpg,jpeg,pjpeg,pjp,avif,jfif,bmp,ico,cur,png,gif,svg,webp,tif,tiff',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $imageurl = null;
            if (isset($category->image) && $category->image != null) {
                $imageurl = $category->image;
            }

            if ($request->hasFile('image')) {
                if ($imageurl != null) {
                    Helper::delete_image($imageurl);
                }
                $imageurl = Helper::image_upload($request->image, "categories");
            }


            $iconurl = null;
            if (isset($category->icon) && $category->icon != null) {
                $iconurl = $category->icon;
            }

            if ($request->hasFile('icon')) {
                if ($iconurl != null) {
                    Helper::delete_image($iconurl);
                }
                $iconurl = Helper::image_upload($request->icon, "categories");
            }
            Categories::where("id", $category->id)->update([
                "name->az_name" => $request->az_name,
                "name->ru_name" => $request->ru_name,
                "name->en_name" => $request->en_name,
                "description->az_description" => $request->az_description,
                "description->ru_description" => $request->ru_description,
                "description->en_description" => $request->en_description,

                "image" => $imageurl,
                "icon" => $iconurl,

                "active" => $request->active
            ]);



            return redirect()->back()->with('success', 'Məlumatınız düzəliş olundu!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $category)
    {
        try {
            $category=Categories::where('id',$category->id)->withTrashed()->first();
            if(isset($category->deleted_at) && $category->deleted_at!=null){
                if(isset($category->image) && $category->image!=null){
                    Helper::delete_image($category->image);
                }
                // View
                $category->forceDelete();
            }else{
                $category->update([
                    "active"=>false
                ]);
                $category->delete();
            }

            return redirect()->back()->with('success', 'Məlumatınız ləvğ edildi.');
        }catch (\Throwable $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }


    public function recycle()
    {
        try{
            $categories = Categories::orderBy('id','desc')->onlyTrashed()->get();

            return view('dashboard.categories.recycle',compact('categories'));

        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    public function restore(Categories $categories,$id)
    {
        try {
            $categories = Categories::where('id',$id)->withTrashed()->restore();

            return redirect()->back()->with('success', 'Məlumatınız geri qaytarıldı.');
        }catch (\Throwable $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
