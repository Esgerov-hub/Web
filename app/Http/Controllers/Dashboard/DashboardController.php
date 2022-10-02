<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Partners;
use App\Models\Products;
use App\Models\Blog;
use App\Models\Categories;
use App\Models\Comments;
use App\Models\ContactUs;
use App\Models\Notifications;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('type',0)->get();
        $partners = Partners::all();

        $categories = Categories::all();

        $contacts = ContactUs::all();

        return view('dashboard.index',compact('users','partners','categories','contacts'));
    }
}
