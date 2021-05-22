<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Home;
use App\Http\Controllers\InfoRequest;
use App\Http\Controllers\api\InfoRequest as ApiInfoRequest;
use App\Http\Controllers\Sandbox;

Route::get('/', [Home::class, 'index'])->name('home');

Route::get('/contact', [InfoRequest::class, 'contact'])->name('contact');

Route::get('/manage', [InfoRequest::class, 'manage'])->name('manage');

Route::get('/download/{id}', [InfoRequest::class, 'download'])->name('download');

Route::get('/sandbox/pdf', [Sandbox::class, 'pdf'])->name('sandbox_pdf');

Route::get('/sandbox/mailtrap', [Sandbox::class, 'mailtrap'])->name('sandbox_mailtrap');


Route::apiResource('api/requests', ApiInfoRequest::class);

Route::get('/api/toggle_is_managed', [ApiInfoRequest::class, 'toggle_is_managed'])->name('toggle_is_managed');