<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function homeAbout()
    {
        $homeAbout = HomeAbout::latest()->get();
        return view('admin.home.index', compact('homeAbout'));
    }

    public function addAbout()
    {
        return view('admin.home.create');
    }

    public function storeAbout(Request $request)
    {
        HomeAbout::insert([
            'title' => $request->title,
            'short_dis' => $request->short_description,
            'long_dis' => $request->long_description,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('home.about')->with('success', 'Інфо з назвою ' . $request->title . ' успішно додано');
    }

    public function editAbout($id)
    {
        $homeAbout = HomeAbout::find($id);
        return view('admin.home.edit', compact('homeAbout'));
    }

    public function updateAbout(Request $request, $id)
    {
        HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_dis' => $request->short_description,
            'long_dis' => $request->long_description,
        ]);
        return Redirect()->route('home.about')->with('success', 'Інфо з назвою ' . $request->title . ' успішно змінено');
    }

    public function deleteAbout($id)
    {
        $delete = HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success', 'Видалено!!!');
    }
}
