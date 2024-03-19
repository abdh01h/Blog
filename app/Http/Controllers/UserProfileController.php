<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Hash;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile');
    }


    public function update(Request $request)
    {

        $id = Auth::id();

        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => 'required|email|max:255|unique:users,email,'.$id,
        ]);

        $inputs = $request->all();

        if(!empty($inputs['old-password']) || !empty($inputs['new-password'])) {

            $validator = Validator::make($inputs, [
                'new-password'      => 'required|min:1|different:old-password|same:password_confirmation',
                'old-password'      => ['required'],
            ],[
                'new-password.required'  => 'The New Password field is required.',
                'new-password.different' => 'New Password should not match the old password.',
                'new-password.same'      => 'New Password and Confirm Password should match.',
            ]);

            if(Hash::check($inputs['old-password'], Auth::user()->password)) {

                $inputs['new-password'] = Hash::make($inputs['new-password']);
                User::find(Auth::id())->update(['password' => $inputs['new-password']]);
                $inputs = Arr::except($inputs, ['old-password', 'new-password', 'password_confirmation']);

            } else {
                $validator->getMessageBag()->add('old-password', "Old Password Doesn't match");
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } else {
            $inputs = Arr::except($inputs, ['old-password', 'new-password', 'password_confirmation']);
        }

        $user = User::find($id);
        $user->update($inputs);

        $request->session()->flash('type', __('success'));
        $request->session()->flash('title', __('Updated Successful'));
        $request->session()->flash('message', __('The Profile Has Been Successfully updated.'));

        return back();

    }



}
