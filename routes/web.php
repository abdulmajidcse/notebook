<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('admin.login');
});

// admin routes
require __DIR__.'/web/admin.php';


