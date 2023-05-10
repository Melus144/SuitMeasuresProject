<?php

use App\DatatableController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/measures/list', [DatatableController::class, 'listMeasures'])->name('datatable.measures');
});
