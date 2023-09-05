<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index($id)
    {
        $category = Category::find($id);
        $articles = $category->articles()->latest()->paginate(5);
        return view('categories.index', [
            'articles' => $articles,
            'category' => $category,
        ]);
    }

}
