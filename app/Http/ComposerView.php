<?php
namespace App\Http;


use App\Http\Controllers\Controller;
use App\Models\Partners;
use App\Models\Settings;
use App\Models\StandartPages;
use GuzzleHttp\Client;
use Illuminate\View\View;

class ComposerView extends Controller
{
    public function compose(View $view)
    {
        $settings = Settings::where('id',1)->first();
        $partners = Partners::where('status',1)->get();
        $abouts = StandartPages::where('type','about')->first();
        return $view->with(['settings' => $settings,'partners' => $partners,'abouts' => $abouts]);
    }
}
