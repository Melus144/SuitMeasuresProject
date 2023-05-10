<?php

use App\Admin\Measures\Controllers\MeasureController;

// RESOURCES
Route::resource('measures', MeasureController::class)->except('show');
