<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function allCat()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    public function addCat(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Тексту дай!!!',
            'category_name.unique' => 'Уже було!!!',
            'category_name.max' => 'Забагато тексту!!!',
        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
//        $category = new Category();
//        $category->category_name = $request->category_name;
//        $category->user_id = Auth::user()->id;
//        $category->save();
        return Redirect()->back()->with('success', 'Категорія: ' . $request->category_name . ' успішно додана');
    }
}
