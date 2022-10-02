<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StandartPagesRequest;
use App\Models\MetaSeo;
use App\Models\StandartPages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StandartPagesController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:standart-pages-view|standart-pages-create|standart-pages-edit|standart-pages-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:standart-pages-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:standart-pages-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:standart-pages-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $standartpages = StandartPages::orderBy('name')->get();

            return view('dashboard.standartpages.index', compact('standartpages'));
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
        try {
            $standartPage = null;
            return view('dashboard.standartpages.create_edit',compact('standartPage'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StandartPagesRequest $request)
    {
        try {
            $title = [
                'az_name' => $request->az_name,
                'ru_name' => $request->ru_name,
                'en_name' => $request->en_name,
            ];

            $description =
                [
                    'az_description' => $request->az_description,
                    'en_description' => $request->en_description,
                    'ru_description' => $request->ru_description,
                ];



            $imageurl = null;
            if ($request->hasFile('bg_image')) {
                $imageurl = Helper::image_upload($request->bg_image, "standartpages");
            }
            $data = new StandartPages();
            $data->name = $title;
            $data->bg_image = $imageurl;
            $data->description = $description;
            $data->type = $request->type;
            $data->save();

            return redirect()->back()->with('success', 'Məlumatınız əlavə edildi.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\StandartPages $standartPages
     * @return \Illuminate\Http\Response
     */
    public function show(StandartPages $standartPage)
    {
        try {

            return view('dashboard.standartpages.show', compact('standartPage'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StandartPages $standartPages
     * @return \Illuminate\Http\Response
     */
    public function edit(StandartPages $standartPage)
    {
        try {
//            dd($standartPage);

            return view('dashboard.standartpages.create_edit', compact('standartPage'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StandartPages $standartPages
     * @return \Illuminate\Http\Response
     */
    public function update(StandartPagesRequest $request, StandartPages $standartPage)
    {
        try {


            $imageurl = null;
            if (isset($standartPage->bg_image) && $standartPage->bg_image != null) {
                $imageurl = $standartPage->bg_image;
            }

            if ($request->hasFile('bg_image')) {
                if ($imageurl != null) {
                    Helper::delete_image($imageurl);
                }
                $imageurl = Helper::image_upload($request->bg_image, "standartpages");
            }


            StandartPages::where("id", $standartPage->id)->update([
                "name->az_name" => $request->az_name,
                "name->ru_name" => $request->ru_name,
                "name->en_name" => $request->en_name,
                "description->az_description" => $request->az_description,
                "description->ru_description" => $request->ru_description,
                "description->en_description" => $request->en_description,
                "bg_image" => $imageurl,
                "type" => $request->type
            ]);


            return redirect()->back()->with('success', 'Məlumatınız düzəliş edildi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\StandartPages $standartPages
     * @return \Illuminate\Http\Response
     */
    public function destroy(StandartPages $standartPage)
    {
        try {

            if (isset($standartPage->image) && $standartPage->image != null) {
                Helper::delete_image($standartPage->image);
            }
            // View
            $standartPage->forceDelete();

            $standartPage->update([
                "status" => false
            ]);
            $standartPage->delete();

            return redirect()->back()->with('success', 'Məlumatınız ləvğ edildi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function recycle()
    {
        try{
            $standartpages = StandartPages::orderBy('id','desc')->onlyTrashed()->get();

            return view('dashboard.standartpages.recycle',compact('standartpages'));

        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    public function restore(StandartPages $standartPage,$id)
    {
        try {
            $standartpages = StandartPages::where('id',$id)->withTrashed()->restore();

            return redirect()->back()->with('success', 'Məlumatınız geri qaytarıldı.');
        }catch (\Throwable $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }


}
