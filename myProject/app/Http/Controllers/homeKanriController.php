<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeKanriController extends Controller
{
    public function postSignin(Request $request)
    {
        $this->validate($request, [
            'loginId' => 'required',
            'loginPass' => 'min:4'
            ]);
           
        // if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
        //     return redirect()->route('user.profile');
        // }
        // return redirect()->back();
        return view('/hello');
    }
}
