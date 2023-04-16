<?php

use Illuminate\Support\Facades\Route;
use App\Front\Customizer\Controllers\CustomizerController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Honeypot\ProtectAgainstSpam;
use Spatie\Sitemap\SitemapGenerator;

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
//... (Només incloses rutes del projecte de mesures)
Route::prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect'])->group(function () {
    Route::get('/', [App\Front\Home\Controllers\HomeController::class, 'index'])->name('home');

    Route::get(LaravelLocalization::transRoute('routes.measures-videos'), [App\Front\MeasuresVideos\MeasuresVideosController::class, 'index'])->name('measures-videos.index');
    Route::post(LaravelLocalization::transRoute('routes.measures-videos-save'), [App\Front\MeasuresVideos\MeasuresVideosController::class, 'saveMeasures'])->name('measures-videos.save');
    Route::post(LaravelLocalization::transRoute('routes.measures-videos-download'), [App\Front\MeasuresVideos\MeasuresVideosController::class, 'downloadPdf'])->name('measures-videos.download');
    Route::get('/my-measures/{measureCode}', [App\Front\MeasuresVideos\MeasuresVideosController::class, 'edit'])->name('measures-videos.edit');

//...
});

Route::fallback(function () {
    return view("front.404");
});
