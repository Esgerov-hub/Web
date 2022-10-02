<?php
namespace App\Http;


use App\Http\Controllers\Controller;

use Illuminate\View\View;
use App\Models\ContactUs;
use App\Models\Comments;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ViewComposer extends Controller
{
    public function compose(View $view): View
    {
        // dd(Carbon::now()->format('d.m.Y'));
        $contacts = ContactUs::where([
        'created_at' => Carbon::now()->format('Y-m-d'),
        'user_id' => Auth::user()->id
        ])->get();




        return $view->with(
            [
                'contacts'=> $contacts,
            ]);
    }
}
