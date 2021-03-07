<?php

use App\Http\Controllers\Dashboard\PostsController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', [PostsController::class, 'index'])->name('dashboard');
Route::get('dashboard/posts/{post}', [PostsController::class, 'show'])->name('dashboard.show');
Route::get('dashboard/about', [PostsController::class, 'about'])->name('dashboard.about');
Route::get('dashboard/categories/{category}', [PostsController::class, 'category'])->name('dashboard.category');
Route::get('dashboard/tags/{tag}', [PostsController::class, 'tag'])->name('dashboard.tag');


Auth::routes(['verify' => true]);
//Auth::routes();

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile/{user}', [PostsController::class, 'profile'])->name('dashboard.profile');
    Route::resource('categories', 'CategoriesController');
    Route::resource('tags', 'TagsController');
    Route::resource('posts', 'PostsController');
    Route::resource('posts/{post}/comments', 'CommentsController');
    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');
    Route::put('restore-posts/{post}', 'PostsController@restore')->name('restore-posts');
    Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');
    Route::put('users/profile', 'UsersController@update')->name('users.update-profile');
    Route::post('users/{user}/update-avatar', 'UsersController@updateAvatar')->name('users.update-avatar');
    Route::post('users/{user}/update-header', 'UsersController@updateHeader')->name('users.update-header');
});

/* Route::middleware(['verifyIsAdmin'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::post('users/{user}/remove-admin', 'UsersController@removeAdmin')->name('users.remove-admin');
}); */

Route::middleware(['auth','verifyIsAdmin'])->group(function () {
    Route::get('/admin/dashboard','Admin\DashboardController@index')->name('admin.dashboard');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::post('users/{user}/make-writer', 'UsersController@makeWriter')->name('users.make-writer');
    Route::post('users/{user}/remove-writer', 'UsersController@removeWriter')->name('users.remove-writer');
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::post('users/{user}/remove-admin', 'UsersController@removeAdmin')->name('users.remove-admin');
    Route::post('users/{user}/make-super-admin', 'UsersController@makeSuperAdmin')->name('users.make-super-admin');
    Route::post('users/{user}/remove-super-admin', 'UsersController@removeSuperAdmin')->name('users.remove-super-admin');
});
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

