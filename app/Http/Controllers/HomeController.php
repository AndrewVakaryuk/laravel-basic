<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function homeSlider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function addSlider()
    {
        return view('admin.slider.create');
    }

    public function storeSlider(Request $request)
    {
//        $validated = $request->validate([
//            'title' => 'required|min:4',
//        ],
//        [
//            'title.required' => 'Тексту дай!!!',
//        ]);
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $last_img = 'image/slider/'.$name_gen;
        Image::make($image)->resize(1920, 1088)->save($last_img);

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('home.slider')->with('success', 'Слайдер з назвою ' . $request->title . ' успішно доданий');
    }
}
