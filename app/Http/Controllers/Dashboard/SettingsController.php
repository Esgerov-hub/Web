<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:settings-view', ['only' => ['index', 'update']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $setting = Settings::latest()->first();

            return view('dashboard.settings.edit', compact('setting'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {


            $address =
                [
                    'az_address' => $request->az_address,
                    'en_address' => $request->en_address,
                    'ru_address' => $request->ru_address,
                ];

            $social_network =
                [
                    'facebook_url' => $request->facebook_url,
                    'linkedin_url' => $request->linkedin_url,
                    'instagram_url' => $request->instagram_url,
                    'youtube_url' => $request->youtube_url,
                    'telegram_url_1' => $request->telegram_url_1,
                    'telegram_url_2' => $request->telegram_url_2,
                    'gmaps_url' => $request->gmaps_url,
                    'whatsapp_1' => $request->whatsapp_1,
                    'whatsapp_2' => $request->whatsapp_2,
                    'phone_1' => $request->phone_1,
                    'phone_2' => $request->phone_2,
                    'email_1' => $request->email_1,
                    'email_2' => $request->email_2,
                ];



            $logo_lt_web = null;

            if ($request->hasFile('logo_lt_web')) {
                $logo_lt_web = Helper::image_upload($request->logo_lt_web, "settings");
            }

            $logo_lt_mobile = null;

            if ($request->hasFile('logo_lt_mobile')) {
                $logo_lt_mobile = Helper::image_upload($request->logo_lt_mobile, "settings");
            }
            $logos =
                [
                    'logo_lt_web' => $logo_lt_web,
                    'logo_lt_mobile' => $logo_lt_mobile,
                ];
            $setting = new Settings();
            $setting->logos = $logos;

            $setting->address = $address;
            $setting->social_network = $social_network;
            $setting->save();

            return redirect()->back()->with('success', 'Məlumatınız əlavə edildi.');

        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $setting)
    {
        try {


            $address =
                [
                    'az_address' => $request->az_address,
                    'en_address' => $request->en_address,
                    'ru_address' => $request->ru_address,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude
                ];

            $social_network =
                [
                    'facebook_url' => $request->facebook_url,
                    'linkedin_url' => $request->linkedin_url,
                    'instagram_url' => $request->instagram_url,
                    'youtube_url' => $request->youtube_url,
                    'telegram_url_1' => $request->telegram_url_1,
                    'telegram_url_2' => $request->telegram_url_2,
                    'gmaps_url' => $request->gmaps_url,
                    'whatsapp_1' => $request->whatsapp_1,
                    'whatsapp_2' => $request->whatsapp_2,
                    'phone_1' => $request->phone_1,
                    'phone_2' => $request->phone_2,
                    'email_1' => $request->email_1,
                    'email_2' => $request->email_2,
                ];



            $logo_for_dark_web = null;
            if(isset($setting->logos['logo_for_dark_web']) && $setting->logos['logo_for_dark_web'] !=null){
                $logo_for_dark_web=$setting->logos['logo_for_dark_web'];
            }


            if ($request->hasFile('logo_for_dark_web')) {
//                if($logo_for_dark_web!=null){
//                    Helper::delete_image($logo_for_dark_web);
//                }            dd($logo_for_dark_web);
                $logo_for_dark_web = Helper::image_upload($request->logo_for_dark_web, "settings");
            }

            $logo_lt_web = null;

            if(isset($setting->logos['logo_lt_web']) && $setting->logos['logo_lt_web'] !=null){
                $logo_lt_web=$setting->logos['logo_lt_web'];
            }
            if ($request->hasFile('logo_lt_web')) {
//                if($logo_lt_web!=null){
//                    Helper::delete_image($logo_lt_web);
//                }
                $logo_lt_web = Helper::image_upload($request->logo_lt_web, "settings");
            }



            $logos =
                [
                    'logo_for_dark_web' => $logo_for_dark_web ?? null,
                    'logo_lt_web' => $logo_lt_web,

                ];
            $setting->logos = $logos;

            $setting->address = $address;
            $setting->social_network = $social_network;

            $setting->save();

            return redirect()->back()->with('success', 'Məlumatınız əlavə edildi.');

        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
