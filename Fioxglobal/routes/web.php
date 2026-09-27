<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/',[UserController::class, 'index'])->name('index');
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/about_us', [UserController::class, 'aboutus'])->name('about_us');
Route::get('/contact_us', [UserController::class, 'contactus'])->name('contact_us');
Route::get('/product/{slug}', [UserController::class, 'productShow'])->name('product.show');
Route::get('/application/{id}', [UserController::class, 'applicationShow'])->name('application.show');

// Inquiry form + captcha (throttled against spam bots)
Route::post('/contact/store', [UserController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');
Route::get('/contact-captcha', [UserController::class, 'captcha'])
    ->middleware('throttle:30,1')
    ->name('contact.captcha');

Route::get('/brochure/download/{brochure}', [UserController::class, 'downloadBrochure'])
    ->name('brochure.download');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','admin')->group(function () {
    Route::get('/add_product', [AdminController::class, 'addproduct'])->name('add_product');
    Route::get('/view_product', [AdminController::class, 'view_product'])->name('view_product');
    Route::post('/store_products', [AdminController::class, 'storeproduct'])->name('store_product');

    Route::get('/edit_product/{id}', [AdminController::class, 'editproduct'])->name('edit_product');
    Route::post('/update_product/{id}', [AdminController::class, 'updateproduct'])->name('update_product');
    Route::get('/delete_product/{id}', [AdminController::class, 'deleteProduct'])->name('delete_product');
    Route::get('/delete_product_image/{id}', [AdminController::class, 'deleteProductImage'])->name('delete_product_image');
    Route::get('/admin/comparison-image/{id}', [AdminController::class, 'deleteComparisonImage'])->name('delete_comparison_image');
    Route::post('/admin/product/reorder', [AdminController::class, 'reorder'])->name('product.reorder');

    // Application routes
    Route::get('/add_application', [AdminController::class, 'addApplication'])->name('add_application');
    Route::post('/store_applications', [AdminController::class, 'storeApplication'])->name('store_application');
    Route::get('/view_applications', [AdminController::class, 'viewApplications'])->name('view_application');

    Route::get('/edit_application/{id}', [AdminController::class, 'editapplication'])->name('edit_application');
    Route::post('/update_application/{id}', [AdminController::class, 'updateapplication'])->name('update_application');
    Route::get('/delete_application_image/{id}', [AdminController::class, 'deleteApplicationImage'])->name('delete_application_image');
    Route::get('/delete_application/{id}', [AdminController::class, 'deleteApplication'])->name('delete_application');
    Route::post('/application/reorder', [AdminController::class, 'reorderApplications'])->name('application.reorder');

    // Brochure routes
    Route::get('/add_brochure', [AdminController::class, 'addBrochure'])->name('add_brochure');
    Route::post('/admin/brochure', [AdminController::class, 'storeBrochure'])->name('brochure.store');
    Route::delete('/admin/brochure/{id}', [AdminController::class, 'destroyBrochure'])->name('brochure.destroy');

    // Contact routes
    Route::get('/view_inquiries', [AdminController::class, 'viewInquiries'])->name('inquiry.view');
    Route::get('/delete_inquiry/{id}', [AdminController::class, 'deleteInquiry'])->name('inquiry.delete');
});

require __DIR__.'/auth.php';