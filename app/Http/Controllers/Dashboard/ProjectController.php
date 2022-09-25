<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\MetaSeo;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $projects = Project::orderBy('id','desc')->get();
            // dd($blogs);
            return view('dashboard.projects.index',compact('projects'));

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
            $project = null;
            $categories = Categories::orderBy("name", "ASC")->get();
            return view('dashboard.projects.create_edit',compact('project','categories'));
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
                    'image' => 'image|mimes:jpg,jpeg,pjpeg,pjp,avif,jfif,bmp,ico,cur,png,gif,svg,webp,tif,tiff',
                    'active' => 'required|integer',
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


            $imageurl=null;
            if($request->hasFile('image')) {
                $imageurl=Helper::image_upload($request->image,"blogs");
            }


            $data = new Project();
            $data->title = $title;
            $data->category_id = $request->category_id;
            $data->image = $imageurl;
            $data->active = $request->active;
            $data->status = $request->status;
            $data->url = $request->url;
            $data->save();


            return redirect()->back()->with('success', 'Məlumatınız əlavə olundu!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        try{
            $categories = Categories::orderBy("name", "ASC")->get();
            return view('dashboard.projects.create_edit',compact('project','categories'));
        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        try {
            $rules =
                [
                    'az_name' => 'required|string|max:255|min:1',
                    'ru_name' => 'required|string|max:255|min:1',
                    'en_name' => 'required|string|max:255|min:1',
                    'image' => 'image|mimes:jpg,jpeg,pjpeg,pjp,avif,jfif,bmp,ico,cur,png,gif,svg,webp,tif,tiff',
                    'active' => 'required|integer',
                    'status' => 'required|integer',

                ];

            $messages =
                [
                    '*.required' => 'Bu sahə doldurulmalı',
                    '*.max' => 'Maksimum 255 ölçüdə olmalı',
                    '*.min' => 'Ölçüsü çox azdır',
                    '*.mimes' => 'Formatı düzgün deyil',
                    '*.integer' => 'Rəqəm olmalı bu sahə'
                ];

            $validator = Validator::make($request->all(), $rules,$messages);


            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $imageurl = null;
            if (isset($project->image) && $project->image != null) {
                $imageurl = $project->image;
            }

            // dd($imageurl);
            if ($request->hasFile('image')) {
                if ($imageurl != null) {
                    Helper::delete_image($imageurl);
                }
                $imageurl = Helper::image_upload($request->image, "blogs");
            }
            Project::where("id", $project->id)->update([
                "title->az_name" => $request->az_name,
                "title->ru_name" => $request->ru_name,
                "title->en_name" => $request->en_name,
                "status" => $request->status,
                "active" => $request->active,
                "image" => $imageurl,
                'url' => $request->url
            ]);


            return redirect()->back()->with('success', 'Məlumatınız düzəliş olundu!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
