<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
  

    public function destroy(Request $request)
    {
        //
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message'=>'User Logout Successfully',
            'alert-type'=>'success',
        );

        return redirect('/login')->with($notification);
    }// End method Signout method

    public function profile()
    {
        //
        $id = Auth::user()->id; // get user id of user dat login

        $adminData = User::findOrFail($id);

        return view('admin.admin_profile_view', compact('adminData'));
        
    }// End method view single user profile

    public function editProfile()
    {
        //
        $id = Auth::user()->id; // get user id of user dat login
        $editData = User::findOrFail($id);

        return view('admin.admin_profile_edit', compact('editData'));

    }// End method edit user profile form

    public function storeProfile(Request $request)
    {
        //NOTE : Using save method

        $id     = Auth::user()->id; // get user id of user dat login
        $data   = User::findOrFail($id); // find user from model i.e database

        // get all the fields from our form
        $data->name         = $request->name;
        $data->email        = $request->email;
        $data->username     = $request->username;

        if ($request->file('profile_image')) {
            # code...
            $file = $request->file('profile_image'); // get file choose from inpute field

            // get filename n generate another name
            $filename = date('YmdHi').$file->getClientOriginalName();

            // move the file 
            $file->move(public_path('upload/admin_images'), $filename);

            // get file field from form and assign file name dat will be submited to db
            $data['profile_image'] =  $filename;

        }

        $data->save();

        $notification = array(
            'message'=>'Admin Profile Updated Successfully',
            'alert-type'=>'success',
        );
        
        
        return redirect()->route('admin.profile')->with($notification);

    }// End method of update user profile


    public function changePassword()
    {
        //
        $id = Auth::user()->id; // get user id of user dat login
        $editData = User::findOrFail($id);

        return view('admin.admin_change_password', compact('editData'));

    }// End method edit user profile form


    public function updatePassword(Request $request)
    {
        //NOTE : Using save method

       

        $validate_data = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',
        ]);

        $hashPassword     = Auth::user()->password; // get authenticated user id of user dat login

        // check if oldpassword comin from form match wat is in db password column
        if (Hash::check($request->oldpassword, $hashPassword)) {
            # code...
            // get authenticated user id
            $users = User::findOrFail(Auth::id());

            $users->password = bcrypt($request->newpassword);

            $users->save();

            session()->flash('message', 'Password Updated Successfully');

            return redirect()->back();
            //
        }else {
            session()->flash('message', 'Old password not match');
            return redirect()->back();
        };
       
        

    }// End method of update user profile
}
