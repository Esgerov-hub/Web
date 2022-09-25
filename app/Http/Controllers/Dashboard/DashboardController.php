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
        $teachers = User::where('type',2)->get();
        $partners = Partners::all();
        $products = Products::all();
        $blogs = Blog::all();
        $categories = Categories::all();
        $notifications =  Notifications::all();
        $comments = Comments::all();
        $contacts = ContactUs::all();

        return view('dashboard.index',compact('users','teachers','partners','products','blogs','categories','notifications','comments','contacts'));
    }
}
