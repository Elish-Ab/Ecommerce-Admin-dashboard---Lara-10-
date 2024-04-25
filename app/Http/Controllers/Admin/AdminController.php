<?php

namespace App\Http\Controllers\Admin;

use Hash;
use Validator;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function index()
    {
        return view('admin.dashboard');
    }

    public function login(Request $req){
        if($req->isMethod('post')){
            $data = $req->all();

            $rules =[
                'email'=> 'required|email|max:255',
                'password'=> 'required|max:30'
            ];

            $customMessage =[
                'email.required'=>"Email is required",
                'email.email'=>'Valid Email is required',
                'password.required'=>'Password is required'
            ];

            $this->validate($req, $rules, $customMessage);

            // echo "<pre>"; print_r($data); die;
            if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password'
            ]])){
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with("error_message","invalid credentials");
            }
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }


    public function updatePassword(Request $req)
    {
        if($req->isMethod('post')){
            $data = $req->all();
            //check if the current password is correct
            if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
                if($data['new_pwd']== $data['confirm_pwd']){
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated successfully');
                }else{
                    return redirect()->back()->with('error_message', 'New password and Confirm password did not match. Retype the correct match');
                }
            }else{
                return redirect()->back()->with('error_message', 'Your current password is incorrect');
            }

        }
        return view('admin.update_password');
    }
    public function checkCurrentPassword(Request $req)
    {
        $data = $req->all();
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }
        
    }
    

    
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
