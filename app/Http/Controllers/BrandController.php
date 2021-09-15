<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    public function allBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function addBrand(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
            [
                'brand_name.required' => 'Тексту дай!!!',
                'brand_name.unique' => 'Уже було!!!',
                'brand_name.min' => 'Потрібно ввести більше 4 символів!!!',
            ]);
        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location . $img_name;
        $brand_image->move($up_location, $img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'crated_at' => Carbon::now()
        ]);
        return Redirect()->back()->with('success', 'Бренд: ' . $request->brand_name . ' успішно доданий');
    }

    public function editBrand($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function  updateBrand(Request $request, $id)
    {
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
        ],
        [
            'brand_name.required' => 'Тексту дай!!!',
            'brand_name.unique' => 'Уже було!!!',
            'brand_name.min' => 'Потрібно ввести більше 4 символів!!!',
        ]);
        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');
        if ($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location . $img_name;
            $brand_image->move($up_location, $img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'updated_at' => Carbon::now()
            ]);
            return Redirect()->back()->with('success', 'Бренд: ' . $request->brand_name . ' успішно відредагований');
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'updated_at' => Carbon::now()
            ]);
            return Redirect()->back()->with('success', 'Бренд: ' . $request->brand_name . ' успішно відредагований');
        }

    }
}
