<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('home', ['activeSection' => 'home']);
})->name('home');

Route::get('/services', function () {
    return view('home', ['activeSection' => 'all-services']);
})->name('services');

Route::get('/design', function () {
    return view('home', ['activeSection' => 'design-services']);
})->name('design');

Route::get('/packages', function () {
    return view('home', ['activeSection' => 'packages']);
})->name('packages');

Route::get('/why-us', function () {
    return view('home', ['activeSection' => 'why-choose-us']);
})->name('why-us');

Route::get('/contact', function () {
    return view('home', ['activeSection' => 'contact']);
})->name('contact');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

// Form submission routes
Route::post('/contact/send', [ContactController::class, 'sendContact'])->name('contact.send');
Route::post('/quote/request', [ContactController::class, 'requestQuote'])->name('quote.request');

// sitemap route
Route::get('/sitemap.xml', function() {
    return response()->file(public_path('sitemap.xml'));
});