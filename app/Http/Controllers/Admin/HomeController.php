<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\NoteBook;

class HomeController extends Controller
{
    public function index()
    {
        $this->data['totalCategory'] = Category::count();
        $this->data['totalNotebook'] = NoteBook::count();
        return view('admin.home', $this->data);
    }
}
