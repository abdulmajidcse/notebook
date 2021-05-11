<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Notebook;

class HomeController extends Controller
{
    public function index()
    {
        $this->data['totalCategory'] = Category::count();
        $this->data['totalNotebook'] = Notebook::count();
        return view('admin.home', $this->data);
    }
}
