<?php
namespace App\Http;


use App\Http\Controllers\Controller;
use App\Models\Partners;
use App\Models\Settings;
use GuzzleHttp\Client;
use Illuminate\View\View;

class ComposerView extends Controller
{
    public function compose(View $view)
    {
        $settings = Settings::where('id',1)->first();
        $partners = Partners::where('status',1)->get();
        return $view->with(['settings' => $settings,'partners' => $partners]);
    }
}
