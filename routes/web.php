<?php

use App\Http\Controllers\Dashboard\CommonControllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\PartnerController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\TeacherController;
use App\Http\Controllers\Dashboard\DeleteUserController;
use App\Http\Controllers\Dashboard\StandartPagesController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\AttributeController;
use App\Http\Controllers\Dashboard\NotificationsController;
use App\Http\Controllers\Dashboard\BlogsController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\PaymentsController;
use App\Http\Controllers\Weblabs\IndexController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {
    Route::get('/', [IndexController::class, 'index'])->name('weblabs.index');

    Route::get('about', [IndexController::class, 'about'])->name('weblabs.about');
    Route::get('service', [IndexController::class, 'service'])->name('weblabs.service');
    Route::get('service/{id}', [IndexController::class, 'service_details'])->name('weblabs.service_details');
    Route::get('teams', [IndexController::class, 'team'])->name('weblabs.teams');
    Route::get('project', [IndexController::class, 'project'])->name('weblabs.project');
//Route::get('blog',[IndexController::class,'blog'])->name('weblabs.blog');
//Route::get('blog/id',[IndexController::class,'blog_details'])->name('weblabs.blog_details');
    Route::get('contact', [IndexController::class, 'contact'])->name('weblabs.contact');
    Route::post('/contact', [IndexController::class, 'contactPost'])->name('post');
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [\App\Http\Controllers\Dashboard\LoginController::class, 'index']);
    Route::post('/login', [\App\Http\Controllers\Dashboard\LoginController::class, 'login'])->name('login');
});

Route::prefix('/home')->middleware('auth')->group(function ()
{
    Route::post('logout', [\App\Http\Controllers\Dashboard\LoginController::class, 'logout'])->name('logout');

    Route::get('/',[DashboardController::class,'index'])->name('dashboard.index');

    //Users

    Route::resource('permissions',PermissionController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('users',UsersController::class);
    Route::get('/users',[UsersController::class,'index'])->name('users.index');
    Route::get('/delete-users',[UsersController::class,'delete'])->name('users.recycle');
    Route::get('/delete-users/{id}',[UsersController::class,'restore'])->name('users.restore');

    //Pages
    Route::resource('partners',PartnerController::class);
    Route::get('/delete-partners',[PartnerController::class,'recycle'])->name('partners.recycle');
    Route::get('/delete-partners/{id}',[PartnerController::class,'restore'])->name('partners.restore');

    Route::post("ckEditorUpload", [CommonControllers::class, 'ckEditorUpload'])->name("ckEditorUpload");
    Route::resource('standart-pages',StandartPagesController::class);

    Route::resource('settings',SettingsController::class);

    //comments
    Route::get('comments',[CommentController::class,'index'])->name('comments.index');
    Route::get('comments/{id}',[CommentController::class,'show'])->name('comments.show');
    Route::delete('comments/delete/{id}',[CommentController::class,'destroy'])->name('comments.destroy');
    Route::put('comments/update/{id}',[CommentController::class,'update'])->name('comments.update');
    Route::patch('comments_change_stat/{id}', [CommentController::class, 'changeStat']);
    Route::get('/delete-comments',[CommentController::class,'recycle'])->name('comments.recycle');
    Route::get('/delete-comments/{id}',[CommentController::class,'restore'])->name('comments.restore');

    //contacts
    Route::get('contacts',[ContactController::class,'index'])->name('contacts.index');
    Route::get('contacts/{id}',[ContactController::class,'show'])->name('contacts.show');
    Route::delete('contacts/delete/{id}',[ContactController::class,'destroy'])->name('contacts.destroy');
    Route::get('/delete-contacts',[ContactController::class,'recycle'])->name('contacts.recycle');
    Route::get('/delete-contacts/{id}',[ContactController::class,'restore'])->name('contacts.restore');

    //Category and metaSeo
    Route::resource('categories',CategoryController::class);
    Route::get('/delete-categories',[CategoryController::class,'recycle'])->name('categories.recycle');
    Route::get('/delete-categories/{id}',[CategoryController::class,'restore'])->name('categories.restore');


    //Attributes
    Route::resource('attributes',AttributeController::class);
    Route::patch('attributes_change_stat/{id}', [AttributeController::class, 'changeStat']);
    Route::get('/delete-attributes',[AttributeController::class,'recycle'])->name('attributes.recycle');
    Route::get('/delete-attributes/{id}',[AttributeController::class,'restore'])->name('attributes.restore');


    //Notification
    Route::resource('notifications',NotificationsController::class);
    Route::post('api/fetch-user', [NotificationsController::class, 'fetchUser']);
    Route::get('/delete-notification',[NotificationsController::class,'recycle'])->name('notifications.recycle');
    Route::get('/delete-notification/{id}',[NotificationsController::class,'restore'])->name('notifications.restore');

    //blogs
    Route::resource('blogs',BlogsController::class);
    Route::get('/delete-blogs',[BlogsController::class,'recycle'])->name('blogs.recycle');
    Route::get('/delete-blogs/{id}',[BlogsController::class,'restore'])->name('blogs.restore');
    //orders
    Route::resource('orders',OrdersController::class);
    Route::get('/delete-orders',[OrdersController::class,'recycle'])->name('orders.recycle');
    Route::get('/delete-orders/{id}',[OrdersController::class,'restore'])->name('orders.restore');


    Route::resource('projects',\App\Http\Controllers\Dashboard\ProjectController::class);
    Route::get('/delete-projects',[\App\Http\Controllers\Dashboard\ProjectController::class,'recycle'])->name('projects.recycle');
    Route::get('/delete-projects/{id}',[\App\Http\Controllers\Dashboard\ProjectController::class,'restore'])->name('projects.restore');

    //payments
    Route::resource('payments',PaymentsController::class);

});

Route::fallback([CommonControllers::class, 'notfound']);
