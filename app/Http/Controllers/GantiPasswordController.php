<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GantiPasswordController extends Controller
{
    public function index()
    {
         if(Auth::guard('admin')->check()){
            return view('changepassword');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function ubahpassword(Request $request)
    {
        if(Auth::guard('admin')->check()){
            $user = Auth::guard('admin')->user();
    
            $userPassword = $user->password;
            
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|same:confirm_password|min:8',
                'confirm_password' => 'required',
            ]);

            if (!Hash::check($request->current_password, $userPassword)) {
                return back()->withErrors(['current_password'=>'password not match']);
            }

            $user->password = Hash::make($request->password);

            $user->save();

            return redirect("home")->with('success','password successfully updated');
        }
        return redirect("login")->with('prosesError', 'Silahkan login terlebih dahulu');
    }
}
