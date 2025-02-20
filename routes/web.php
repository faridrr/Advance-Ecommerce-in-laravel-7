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

Auth::routes(['register'=>false]);

Route::get('user/login','FrontendController@login')->name('login.form');
Route::post('user/login','FrontendController@loginSubmit')->name('login.submit');
Route::get('user/logout','FrontendController@logout')->name('user.logout');

Route::get('user/register','FrontendController@register')->name('register.form');
Route::post('user/register','FrontendController@registerSubmit')->name('register.submit');
// Reset password
Route::post('password-reset', 'FrontendController@showResetForm')->name('password.reset');
// Socialite
Route::get('login/{provider}/', 'Auth\LoginController@redirect')->name('login.redirect');
Route::get('login/{provider}/callback/', 'Auth\LoginController@Callback')->name('login.callback');

Route::get('/','FrontendController@home')->name('home');

// Frontend Routes
Route::get('/home', 'FrontendController@index');
Route::get('/about-us','FrontendController@aboutUs')->name('about-us');
Route::get('/contact','FrontendController@contact')->name('contact');
Route::post('/contact/message','MessageController@store')->name('contact.store');
Route::get('product-detail/{slug}','FrontendController@productDetail')->name('product-detail');
Route::post('/product/search','FrontendController@productSearch')->name('product.search');
Route::get('/product-cat/{slug}','FrontendController@productCat')->name('product-cat');
Route::get('/product-sub-cat/{slug}/{sub_slug}','FrontendController@productSubCat')->name('product-sub-cat');
Route::get('/product-sub-cat/{slug}/{sub_slug}/{sub_slug1}','FrontendController@productSubCat1')->name('product-sub-cat1');
Route::get('/product-sub-cat/{slug}/{sub_slug}/{sub_slug1}/{sub_slug2}','FrontendController@productSubCat2')->name('product-sub-cat2');
Route::get('/product-brand/{slug}','FrontendController@productBrand')->name('product-brand');
// Cart section
Route::get('/add-to-cart/{slug}','CartController@addToCart')->name('add-to-cart');
Route::post('/add-to-cart','CartController@singleAddToCart')->name('single-add-to-cart');
Route::get('cart-delete/{id}','CartController@cartDelete')->name('cart-delete');
Route::post('cart-update','CartController@cartUpdate')->name('cart.update');

Route::get('/cart',function(){
    return view('frontend.pages.cart');
})->name('cart');
Route::get('/checkout','CartController@checkout')->name('checkout');
// Wishlist
Route::get('/wishlist',function(){
    return view('frontend.pages.wishlist');
})->name('wishlist');
Route::get('/wishlist/{slug}','WishlistController@wishlist')->name('add-to-wishlist')->middleware('user');
Route::get('wishlist-delete/{id}','WishlistController@wishlistDelete')->name('wishlist-delete');
Route::post('cart/order','OrderController@store')->name('cart.order');
Route::get('order/pdf/{id}','OrderController@pdf')->name('order.pdf');
Route::get('/income','OrderController@incomeChart')->name('product.order.income');
Route::get('/income1','OrderController@incomeChart1')->name('product.order.income1');
Route::get('/income2','OrderController@incomeChart2')->name('product.order.income2');
Route::get('/income3','OrderController@incomeChart3')->name('product.order.income3');

Route::get('/incomeChartMonth/{month}','OrderController@incomeChartMonth')->name('product.order.incomeMonth');
Route::get('/incomeChartMonth1/{month}','OrderController@incomeChartMonth1')->name('product.order.incomeMonth1');
Route::get('/incomeChartMonth2/{month}','OrderController@incomeChartMonth2')->name('product.order.incomeMonth2');
Route::get('/incomeChartMonth3/{month}','OrderController@incomeChartMonth3')->name('product.order.incomeMonth3');

Route::get('/incomeChartMonthStandard/{month}','OrderController@incomeChartMonthStandard')->name('product.order.incomeMonthStandard');
Route::get('/incomeChartMonthStandard1/{month}','OrderController@incomeChartMonthStandard1')->name('product.order.incomeMonthStandard1');
Route::get('/incomeChartMonthStandard2/{month}','OrderController@incomeChartMonthStandard2')->name('product.order.incomeMonthStandard2');
Route::get('/incomeChartMonthStandard3/{month}','OrderController@incomeChartMonthStandard3')->name('product.order.incomeMonthStandard3');

Route::get('/incomeChartMonthLogo/{month}','OrderController@incomeChartMonthLogo')->name('product.order.incomeMonthLogo');
Route::get('/incomeChartMonthLogo1/{month}','OrderController@incomeChartMonthLogo1')->name('product.order.incomeMonthLogo1');
Route::get('/incomeChartMonthLogo2/{month}','OrderController@incomeChartMonthLogo2')->name('product.order.incomeMonthLogo2');
Route::get('/incomeChartMonthLogo3/{month}','OrderController@incomeChartMonthLogo3')->name('product.order.incomeMonthLogo3');

Route::get('/incomeChartMonthPersonalized/{month}','OrderController@incomeChartMonthPersonalized')->name('product.order.incomeMonthPersonalized');
Route::get('/incomeChartMonthPersonalized1/{month}','OrderController@incomeChartMonthPersonalized1')->name('product.order.incomeMonthPersonalized1');
Route::get('/incomeChartMonthPersonalized2/{month}','OrderController@incomeChartMonthPersonalized2')->name('product.order.incomeMonthPersonalized2');
Route::get('/incomeChartMonthPersonalized3/{month}','OrderController@incomeChartMonthPersonalized3')->name('product.order.incomeMonthPersonalized3');



// Route::get('/user/chart','AdminController@userPieChart')->name('user.piechart');
Route::get('/product-grids/{category?}','FrontendController@productGrids')->name('product-grids');
Route::post('/product-grids/{category?}','FrontendController@productGrids')->name('product-grids-filter');
Route::get('/product-lists','FrontendController@productGrids')->name('product-lists');
Route::match(['get','post'],'/filter','FrontendController@productFilter')->name('shop.filter');
// Order Track
Route::get('/product/track','OrderController@orderTrack')->name('order.track');
Route::post('product/track/order','OrderController@productTrackOrder')->name('product.track.order');
// Blog
Route::get('/blog','FrontendController@blog')->name('blog');
Route::get('/blog-detail/{slug}','FrontendController@blogDetail')->name('blog.detail');
Route::get('/blog/search','FrontendController@blogSearch')->name('blog.search');
Route::post('/blog/filter','FrontendController@blogFilter')->name('blog.filter');
Route::get('blog-cat/{slug}','FrontendController@blogByCategory')->name('blog.category');
Route::get('blog-tag/{slug}','FrontendController@blogByTag')->name('blog.tag');

// NewsLetter
Route::post('/subscribe','FrontendController@subscribe')->name('subscribe');

// Product Review
Route::resource('/review','ProductReviewController');
Route::post('product/{slug}/review','ProductReviewController@store')->name('review.store');

// Post Comment
Route::post('post/{slug}/comment','PostCommentController@store')->name('post-comment.store');
Route::resource('/comment','PostCommentController');
// Coupon
Route::post('/coupon-store','CouponController@couponStore')->name('coupon-store');
// Payment
Route::get('payment', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');



// Backend section start

Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/','AdminController@index');
    Route::get('/home/{month?}','AdminController@index')->name('admin');
    Route::get('/file-manager',function(){
        return view('backend.layouts.file-manager');
    })->name('file-manager');
    // user route
    Route::resource('users','UsersController');
    // Banner
    Route::resource('banner','BannerController');
    // Brand
    Route::resource('brand','BrandController');
    // Profile
    Route::get('/profile','AdminController@profile')->name('admin-profile');
    Route::post('/profile/{id}','AdminController@profileUpdate')->name('profile-update');
    // Category
    Route::resource('/category','CategoryController');
    // Product
    Route::resource('/product','ProductController');
    Route::get('/products/stats','ProductController@stats')->name('product.stats');
    Route::post('/products/stats','ProductController@search')->name('product.stats.search');
    // Ajax for sub category
    Route::post('/category/{id}/child','CategoryController@getChildByParent');
    // POST category
    Route::resource('/post-category','PostCategoryController');
    // Post tag
    Route::resource('/post-tag','PostTagController');
    // Post
    Route::resource('/post','PostController');
    // Message
    Route::resource('/message','MessageController');
    Route::get('/message/five','MessageController@messageFive')->name('messages.five');

    // Order
    Route::resource('/order','OrderController');
    Route::post('/order','OrderController@search')->name('order.search');
    Route::post('/order/updateData/{id}','OrderController@updateData')->name('order.updateData');
    Route::post('/storeAdmin','OrderController@storeAdmin')->name('order.storeAdmin');

    // Cart

    Route::get('/cart/edit/{id}','CartController@edit')->name('cart.edit');
    Route::post('/cart/update/{id}','CartController@update')->name('admin.cart.update');
    // Shipping
    Route::resource('/shipping','ShippingController');
    // Coupon
    Route::resource('/coupon','CouponController');
    // Settings
    Route::get('settings','AdminController@settings')->name('settings');
    Route::post('setting/update','AdminController@settingsUpdate')->name('settings.update');

    // Notification
    Route::get('/notification/{id}','NotificationController@show')->name('admin.notification');
    Route::get('/notifications','NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}','NotificationController@delete')->name('notification.delete');
    // Password Change
    Route::get('change-password', 'AdminController@changePassword')->name('change.password.form');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('change.password');
});










// User section start
Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    Route::get('/','HomeController@index')->name('user');
     // Profile
     Route::get('/profile','HomeController@profile')->name('user-profile');
     Route::post('/profile/{id}','HomeController@profileUpdate')->name('user-profile-update');
    //  Order
    Route::get('/order',"HomeController@orderIndex")->name('user.order.index');
    Route::get('/order/show/{id}',"HomeController@orderShow")->name('user.order.show');
    Route::delete('/order/delete/{id}','HomeController@userOrderDelete')->name('user.order.delete');
    // Product Review
    Route::get('/user-review','HomeController@productReviewIndex')->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}','HomeController@productReviewDelete')->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}','HomeController@productReviewEdit')->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}','HomeController@productReviewUpdate')->name('user.productreview.update');

    // Post comment
    Route::get('user-post/comment','HomeController@userComment')->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}','HomeController@userCommentDelete')->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}','HomeController@userCommentEdit')->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}','HomeController@userCommentUpdate')->name('user.post-comment.update');

    // Password Change
    Route::get('change-password', 'HomeController@changePassword')->name('user.change.password.form');
    Route::post('change-password', 'HomeController@changPasswordStore')->name('change.password');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
