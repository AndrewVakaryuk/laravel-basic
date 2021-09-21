<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allCat()
    {
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'trashCat'));
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

    public function editCat($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function updateCat(Request $request, $id)
    {
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);
        return Redirect()->route('all.category')->with('success', 'Назву категорії змінено на: ' . $request->category_name . '.');
    }

    public function softDeleteCat($id)
    {
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Категорію переміщено в корзину.');
    }

    public function restoreCat($id)
    {
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Категорію відновлено.');
    }

    public function deleteCat($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Категорію видалено остаточно.');
    }
}
