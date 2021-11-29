<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function adminContact()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function adminAddContact()
    {
        return view('admin.contact.create');
    }

    public function adminStoreContact(Request $request)
    {
        Contact::insert([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('admin.contact')->with('success', 'Contact успішно доданий');
    }

    public function contact()
    {
        $contacts = Contact::all()->first();
        return view('pages.contact', compact('contacts'));
    }
}
