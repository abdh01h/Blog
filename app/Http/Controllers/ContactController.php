<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        return view('contact');
    }

    public function store(Request $request) {

        $validateData = $request->validate([
            'name'      => 'required|min:1|max:255',
            'email'     => 'required|max:255',
            'message'   => 'required|min:3|max:255',
        ]);

        return redirect()->to('/');

    }


}
