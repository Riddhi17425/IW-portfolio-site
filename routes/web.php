<?php

use App\Http\Controllers\admin\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\IndustryController;
use App\Http\Controllers\admin\KeyFeatureController;
use App\Http\Controllers\admin\ServiceController;	
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\TabingController;

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

//Front route
// Route for the dashboard (home page) showing all industries and projects
Route::get('/', [dashboardController::class, 'index'])->name('home');
Route::get('/filter-projects', [dashboardController::class, 'filterProjects']);
Route::get('/captcha-image', [CaptchaController::class, 'image'])->name('captcha.image');
Route::get('/projects/{projectUrl}', [dashboardController::class, 'projectDetail'])->name('projectdetail');
Route::get('/contact', [dashboardController::class, 'contact'])->name('contact');
Route::get('thank-you', [dashboardController::class, 'thankyou'])->name('thankyou');
Route::get('/captcha-image', [CaptchaController::class, 'image'])->name('captcha.image');
Route::post('contact-store', [dashboardController::class, 'contactstore'])->name('contact.store');



// Admin panel routes
Route::middleware('guest')->group(function(){
	Route::get('/login',[LoginController::class , 'login_page'])->name('login'); 
	Route::Post('/login',[LoginController::class , 'login'])->name('login'); 
}); 

Route::post('/logout' , [LoginController::class , 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {	
 	Route::get('/admin/dashboard', [adminController::class, 'admin'])->name('admin.dashboard');
		
	Route::resource('blog', BlogController::class);
	Route::resource('category', CategoryController::class);
	Route::resource('product', ProjectController::class);
	Route::resource('industry', IndustryController::class);
	Route::resource('tabing', TabingController::class);
	Route::resource('keyfeature', KeyFeatureController::class);
	Route::resource('service', ServiceController::class);
});