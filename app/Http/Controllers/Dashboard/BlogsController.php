<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\MetaSeo;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helper;
use App\Models\AdditionalImages;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:blogs-view|blogs-create|blogs-edit|blogs-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:blogs-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:blogs-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:blogs-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $blogs = Blog::orderBy('id','desc')->with('users')->get();
            // dd($blogs);
            return view('dashboard.blogs.index',compact('blogs'));

        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $blog = null;
            $categories = Categories::orderBy("name", "ASC")->get();
            return view('dashboard.blogs.create_edit',compact('blog','categories'));
        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
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

            $blogRules =
            [
                'az_name' => 'required|string|max:255|min:1',
                'ru_name' => 'required|string|max:255|min:1',
                'en_name' => 'required|string|max:255|min:1',
                'az_description' => 'required|min:1',
                'ru_description' => 'required|min:1',
                'en_description' => 'required|min:1',
                'image' => 'image|mimes:jpg,jpeg,pjpeg,pjp,avif,jfif,bmp,ico,cur,png,gif,svg,webp,tif,tiff',
                'type' => 'required|integer',
                'status' => 'required|integer',
                
            ];

            $blogMessages = 
            [
                '*.required' => 'Bu sahə doldurulmalı',
                '*.max' => 'Maksimum 255 ölçüdə olmalı',
                '*.min' => 'Ölçüsü çox azdır',
                '*.mimes' => 'Formatı düzgün deyil',
                '*.integer' => 'Rəqəm olmalı bu sahə'
            ];

            $validator = Validator::make($request->all(), $blogRules,$blogMessages);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $title = [
                'az_name' => $request->az_name,
                'ru_name' => $request->ru_name,
                'en_name' => $request->en_name,
            ];

            $description = [
                'az_description' => $request->az_description,
                'ru_description' => $request->ru_description,
                'en_description' => $request->en_description,
            ];

            $slugs = [
                'az_slug' => Str::slug(trim($request->az_name)),
                'ru_slug' => Str::slug(trim($request->ru_name)),
                'en_slug' => Str::slug(trim($request->en_name)),
            ];

            $meta_title = [
                'az_meta_title' => $request->az_meta_title,
                'ru_meta_title' => $request->ru_meta_title,
                'en_meta_title' => $request->en_meta_title,
            ];
            
            $meta_description = [
                'az_meta_description' => $request->az_meta_description,
                'ru_meta_description' => $request->ru_meta_description,
                'en_meta_description' => $request->en_meta_description,
            ];
            $meta_keywords = [
                'az_meta_keywords' => $request->az_meta_keywords,
                'ru_meta_keywords' => $request->ru_meta_keywords,
                'en_meta_keywords' => $request->en_meta_keywords,
            ];

            $imageurl=null;
            if($request->hasFile('image')) {
                $imageurl=Helper::image_upload($request->image,"blogs");
            }

            $additional_images_url=null;
            if($request->hasFile('additional_images')) {
                $additional_images_url=Helper::image_upload($request->additional_images,"additional_images");
            }

            $data = new Blog();
            $data->user_id = Auth::user()->id;
            $data->title = $title;
            $data->slug = $slugs;
            $data->category_id = $request->category_id;
            $data->description = $description;
            $data->image = $imageurl;
            $data->type = $request->type;
            $data->status = $request->status;
            $data->save();

            $seo = new MetaSeo();
            $seo->name = $meta_title;
            $seo->description = $meta_description;
            $seo->keyword = $meta_keywords;
            $seo->type = "blogs";
            $seo->element_id = $data->id;
            $seo->save();

            $additional_images = new AdditionalImages();
            $additional_images->image = $additional_images_url;
            $additional_images->type = 'blogs';
            $additional_images->element_id = $data->id;
            $additional_images->save();

            return redirect()->back()->with('success', 'Məlumatınız əlavə olundu!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        try{
            $categories = Categories::orderBy("name", "ASC")->get();
           
            return view('dashboard.blogs.show',compact('blog','categories'));
        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        // dd($blog->images->image);
        try{
            $categories = Categories::orderBy("name", "ASC")->get();
            return view('dashboard.blogs.create_edit',compact('blog','categories'));
        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        try {
            $blogRules =
            [
                'az_name' => 'required|string|max:255|min:1',
                'ru_name' => 'required|string|max:255|min:1',
                'en_name' => 'required|string|max:255|min:1',
                'az_description' => 'required|min:1',
                'ru_description' => 'required|min:1',
                'en_description' => 'required|min:1',
                'image' => 'image|mimes:jpg,jpeg,pjpeg,pjp,avif,jfif,bmp,ico,cur,png,gif,svg,webp,tif,tiff',
                'type' => 'required|integer',
                'status' => 'required|integer',
                
            ];

            $blogMessages = 
            [
                '*.required' => 'Bu sahə doldurulmalı',
                '*.max' => 'Maksimum 255 ölçüdə olmalı',
                '*.min' => 'Ölçüsü çox azdır',
                '*.mimes' => 'Formatı düzgün deyil',
                '*.integer' => 'Rəqəm olmalı bu sahə'
            ];

            $validator = Validator::make($request->all(), $blogRules,$blogMessages);


            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $imageurl = null;
            if (isset($blog->image) && $blog->image != null) {
                $imageurl = $blog->image;
            }

            // dd($imageurl);
            if ($request->hasFile('image')) {
                if ($imageurl != null) {
                    Helper::delete_image($imageurl);
                }
                $imageurl = Helper::image_upload($request->image, "blogs");
            }

            $additional_image = AdditionalImages::where(['element_id' => $blog->id,'type' => 'blogs'])->first();
            // dd($additional_image);
            $additional_images_url = null;
            if (isset($additional_image->image) && $additional_image->image != null) {
                $additional_images_url = $additional_image->image;
            }

            if ($request->hasFile('additional_images')) {
                
                // if ($additional_images_url != null) {
                //     // dd('salam');
                //     Helper::delete_image($additional_images_url);
                // }
                // dd('salam');
                $additional_images_url = Helper::image_upload($request->additional_images, "additional_images");
            }

            Blog::where("id", $blog->id)->update([
                "title->az_name" => $request->az_name,
                "title->ru_name" => $request->ru_name,
                "title->en_name" => $request->en_name,
                "description->az_description" => $request->az_description,
                "description->ru_description" => $request->ru_description,
                "description->en_description" => $request->en_description,
                "slug->az_slug" => Str::slug(trim($request->az_name)),
                "slug->ru_slug" => Str::slug(trim($request->ru_name)),
                "slug->en_slug" => Str::slug(trim($request->en_name)),
                "status" => $request->status,
                "type" => $request->type,
                "image" => $imageurl,
            ]);
           
            $meta_title = [
                'az_meta_title' => $request->az_meta_title,
                'ru_meta_title' => $request->ru_meta_title,
                'en_meta_title' => $request->en_meta_title,
            ];
            
            $meta_description = [
                'az_meta_description' => $request->az_meta_description,
                'ru_meta_description' => $request->ru_meta_description,
                'en_meta_description' => $request->en_meta_description,
            ];
            $meta_keywords = [
                'az_meta_keywords' => $request->az_meta_keywords,
                'ru_meta_keywords' => $request->ru_meta_keywords,
                'en_meta_keywords' => $request->en_meta_keywords,
            ];
            MetaSeo::where(['element_id' => $blog->id,'type' => 'blogs'])->update(
                [
                    'name' => $meta_title,
                    'description' => $meta_description,
                    'keyword' => $meta_keywords,
                ]);

                AdditionalImages::where(['element_id' => $blog->id,'type' => 'blogs'])->update(
                    [
                        'image' => $additional_images_url,
                    ]);

            return redirect()->back()->with('success', 'Məlumatınız düzəliş olundu!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        try {
            $blog=Blog::where('id',$blog->id)->withTrashed()->first();
            if(isset($blog->deleted_at) && $blog->deleted_at!=null){
                if(isset($blog->image) && $blog->image!=null){
                    Helper::delete_image($blog->image);
                }
                // View
                $blog->forceDelete();
            }else{
                $blog->update([
                    "status"=>false
                ]);
                $blog->delete();
            }

            return redirect()->back()->with('success', 'Məlumatınız ləvğ edildi.');
        }catch (\Throwable $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    public function recycle()
    {
        try{
            $blogs = Blog::orderBy('id','desc')->with('users')->onlyTrashed()->get();
           
            return view('dashboard.blogs.recycle',compact('blogs'));

        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    public function restore(Blog $blog,$id)
    {
        try {
            $blogs = Blog::where('id',$id)->withTrashed()->restore();

            return redirect()->back()->with('success', 'Məlumatınız geri qaytarıldı.');
        }catch (\Throwable $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }  
    
    
}
