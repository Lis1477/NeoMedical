<?php

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
Route::post('/callback/form', 'CallbackFormController@postIndex');
Route::post('/thanks-page', 'OnlineFormController@postIndex');
Route::post('/contact/form', 'ContactFormController@postIndex');

Route::get('/', 'BaseController@getIndex');

Route::prefix('uslugi')->group(function(){
	Route::get('/', 'ServiceController@getIndex');
	Route::get('/{slug}', 'ServiceAreaController@getIndex');
});

Route::get('/o-tsentre', 'AboutCenterController@getIndex');

Route::get('/tseny', 'PriceController@getIndex');

Route::get('/kontakty', 'ContactController@getIndex');

Route::get('/onlain-zapis', 'OnlineController@getIndex');

// Авторизация
//Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Админка
Route::prefix('adm')->middleware(['auth', 'auth'])->group(function() {
    Route::get('/', 'Admin\AdminController@index')->name('admin');

    Route::get('/main-category/choice-category', 'Admin\MainCategoryController@mainCategoryList')->name('main-category-choice');
    Route::get('/main-category/edit-form/{id}', 'Admin\MainCategoryController@mainCategoryEditForm')->name('category-edit-form');
    Route::post('/main-category/edit/{id}', 'Admin\MainCategoryController@mainCategoryEdit')->name('category-edit');


    Route::get('/service/choice-service', 'Admin\ServiceController@choiceService')->name('service-choice');
    Route::post('/service/edit-icon/{id}', 'Admin\ServiceController@editIcon')->name('service-edit-icon');
    Route::get('/service/edit-form/{id}', 'Admin\ServiceController@serviceEditForm')->name('service-edit-form');
    Route::post('/service/edit/{id}', 'Admin\ServiceController@editService')->name('service-edit');

    Route::get('/slider', 'Admin\SliderController@viewSlides')->name('slides');
    Route::post('/slider/add', 'Admin\SliderController@addSlide')->name('slide-add');
    Route::post('/slider-edit/{id}', 'Admin\SliderController@editSlide')->name('slide-edit');
    Route::get('/slide-del/{id}', 'Admin\SliderController@deleteSlideElement')->name('slide-delete');

    Route::get('/gallery', 'Admin\GalleryController@viewGallery')->name('gallery');
    Route::post('/gallery/add', 'Admin\GalleryController@addGallery')->name('gallery-add');
    Route::post('/gallery-edit/{id}', 'Admin\GalleryController@editGallery')->name('gallery-edit');
    Route::get('/gallery-del/{id}', 'Admin\GalleryController@deleteGalleryElement')->name('gallery-delete');

    Route::get('/price-category/list', 'Admin\PriceCategoryController@priceCategoryList')->name('price-category-list');
    Route::get('/price-category/edit-form/{id}', 'Admin\PriceCategoryController@priceCategoryEditForm')->name('price-category-edit-form');
    Route::post('/price-category/edit/{id}', 'Admin\PriceCategoryController@priceCategoryEdit')->name('price-category-edit');
    Route::get('/price-category/add-form', 'Admin\PriceCategoryController@priceCategoryAddForm')->name('price-category-add-form');
    Route::post('/price-category/add', 'Admin\PriceCategoryController@priceCategoryAdd')->name('price-category-add');
    Route::get('/price-category/del/{id}', 'Admin\PriceCategoryController@priceCategoryDelete')->name('price-category-delete');

    Route::get('/price-choice', 'Admin\PriceController@choiceService')->name('price-choice');
    Route::get('/price-edit/{id}', 'Admin\PriceController@viewPrices')->name('price-view');
    Route::post('/price-edit/edit/{id}', 'Admin\PriceController@editPrice')->name('price-edit');
    Route::get('/price-add', 'Admin\PriceController@priceAddForm')->name('price-add-form');
    Route::post('/price-add/add', 'Admin\PriceController@addPrice')->name('price-add');
    Route::get('/price-del/{id}', 'Admin\PriceController@deletePriceElement')->name('price-delete');

    Route::get('/admin/add-form', 'Admin\AdminRedactorController@adminAddForm')->name('admin-add-form');
    Route::post('/admin/add', 'Admin\AdminRedactorController@adminAdd')->name('admin-add');
    Route::get('/admin/list', 'Admin\AdminRedactorController@adminList')->name('admin-list');
    Route::get('/admin/edit-form/{id}', 'Admin\AdminRedactorController@adminEditForm')->name('admin-edit-form');
    Route::post('/admin/edit/{id}', 'Admin\AdminRedactorController@adminEdit')->name('admin-edit');
    Route::get('/admin/del/{id}', 'Admin\AdminRedactorController@adminDelete')->name('admin-delete');

});
