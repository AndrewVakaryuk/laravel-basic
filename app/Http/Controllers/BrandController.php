<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
//        $name_gen = hexdec(uniqid());
//        $img_ext = strtolower($brand_image->getClientOriginalExtension());
//        $img_name = $name_gen . '.' . $img_ext;
//        $up_location = 'image/brand/';
//        $last_img = $up_location . $img_name;
//        $brand_image->move($up_location, $img_name);

        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        $last_img = 'image/brand/'.$name_gen;
        Image::make($brand_image)->resize(300, 200)->save($last_img);


        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
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

    public function deleteBrand($id)
    {
        $image = Brand::find($id)->brand_image;
        unlink($image);
        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Бренд успішно видалений');
    }
    public function multiPic()
    {
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }

    public function storeImg(Request $request)
    {
        $request->validate(
            [
                'image' => 'required',
                'image.*' => 'mimes:jpeg,jpg,png'
            ]);
        $image = $request->file('image');
        foreach ($image as $multi_image) {

            $name_gen = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
            $last_img = 'image/multi/' . $name_gen;
            Image::make($multi_image)->resize(300, 300)->save($last_img);

            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }
        return Redirect()->back()->with('success', 'Файли успішно додано');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect()->route('login')->with('success', 'User Logout');
    }
}
