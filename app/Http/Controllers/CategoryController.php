<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCat()
    {
//        $categories
        return view('admin.category.index');
    }

    public function addCat(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Тексту дай!!!',
            'category_name.max' => 'Забагато тексту!!!',
        ]);
    }
}
