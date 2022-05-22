<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\PortfolioController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('frontend.index');
});







// Admin All Route
Route::controller(AdminController::class)->group(function() {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');

    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::get('/edit/profile', 'editProfile')->name('edit.profile');

    Route::post('/store/profile', 'storeProfile')->name('store.profile');

    Route::get('/change/password', 'changePassword')->name('change.password');
    Route::post('/update/password', 'updatePassword')->name('update.password');
});







// HomeSlide All Route
Route::controller(HomeSliderController::class)->group(function() {

    Route::get('/admin/home/slide', 'edit')->name('home.slide');
    Route::post('/admin/update/slide', 'update')->name('update.slide');
});







// AboutPage All Route
Route::controller(AboutController::class)->group(function() {

    Route::get('/admin/about/page', 'edit')->name('about.page');
    Route::post('/admin/update/about', 'update')->name('update.about');

    Route::get('/about', 'HomeAbout')->name('home.about');

    Route::get('/admin/about/multi/image', 'AddAboutMultiImage')->name('about.multi.image');  // to show create form
    Route::post('/admin/store/multi/image', 'StoreAboutMultiImage')->name('store.multi.image'); // to persist create it t db
    Route::get('/admin/all/multi/image', 'AllAboutMultiImage')->name('all.multi.image'); // to show all 
    Route::get('/admin/edit/multi/image/{id}', 'EditAboutMultiImage')->name('edit.multi.image'); // to show edit form
    Route::post('/admin/update/multi/image', 'UpdateAboutMultiImage')->name('update.multi.image');// to persist edit it t db

    Route::get('/admin/delete/multi/image/{id}', 'DeleteAboutMultiImage')->name('delete.multi.image');

});


// Portfolio All Route
Route::controller(PortfolioController::class)->group(function() {

    
    Route::get('/admin/all/portfolio', 'AllPortfolio')->name('all.portfolio'); // to show all 
    Route::get('/admin/add/portfolio', 'AddPortfolio')->name('add.portfolio');  // to show create form
    Route::post('/admin/store/portfolio', 'StorePortfolio')->name('store.portfolio');// to persist create to db
    Route::get('/admin/edit/portfolio/{id}', 'EditPortfolio')->name('edit.portfolio'); // to show edit form
    Route::post('/admin/update/portfolio', 'UpdatePortfolio')->name('update.portfolio');// to edit create to db

    Route::get('/admin/delete/portfolio/{id}', 'DeletePortfolio')->name('delete.portfolio');

    Route::get('/admin/portfolio/details/{id}', 'DetailsPortfolio')->name('portfolio.details');
    
    Route::get('/admin/portfolio/page', 'Portfolio')->name('home.portfolio');

});

// Blog Category All Route
Route::controller(BlogCategoryController::class)->group(function() {

    
    Route::get('/admin/all/blog/category', 'AllBlogCategory')->name('all.blog.category'); // to show all 

    Route::get('/admin/add/blog/category', 'AddBlogCategory')->name('add.blog.category');  // to show create form
    Route::post('/admin/store/blog/category', 'StoreCategory')->name('store.category');// to persist create to db

    Route::get('/admin/edit/blog/category/{id}', 'EditCategory')->name('edit.blog.category'); // to show edit form
    Route::post('/admin/update/blog/category', 'UpdateCategory')->name('update.blog.category');// to persist edit create to db

    Route::get('/admin/delete/blog/category/{id}', 'DeleteCategory')->name('delete.blog.category');


});


// Blog All Route
Route::controller(BlogController::class)->group(function() {

    
    Route::get('/admin/all/blog', 'AllBlog')->name('all.blog'); // to show all 

    Route::get('/admin/add/blog', 'AddBlog')->name('add.blog');  // to show create form
    Route::post('/admin/store/blog', 'StoreBlog')->name('store.blog');// to persist create to db

    Route::get('/admin/edit/blog/{id}', 'EditBlog')->name('edit.blog'); // to show edit form
    Route::post('/admin/update/blog', 'UpdateBlog')->name('update.blog');// to persist edit create to db

    Route::get('/admin/delete/blog/{id}', 'DeleteBlog')->name('delete.blog');


    Route::get('/admin/blog/details/{id}', 'BlogDetails')->name('blog.details');
    Route::get('/admin/category/details/{id}', 'BlogCategory')->name('category.post');
    Route::get('/admin/blog/', 'HomeBlog')->name('home.blog');


});






Route::get('/dashboard', function () {
    // return view('dashboard'); // original breeze view
    return view('admin.index'); // change by adam
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
