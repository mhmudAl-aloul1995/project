<?php

namespace App\Http\Controllers\main;

use App\Category;
use App\Folder;
use App\Http\Controllers\Controller;
use App\Research;
use App\User;
use App\Version;
use View;
use Yajra\Datatables\Enginges\EloquentEngine;
use Illuminate\Http\Request;
use Mail;
use App\Mail\JournalMail;
class signupController extends Controller
{


    public function index()
    {


        return View::make('main/signup');

    }
    public function registration(Request $request)
    {
        /*$name = 'Journal Gaza University';
        $password = 'Journal Gaza University';
        dd(Mail::to('mhmudaloul@gmail.com')->send(new JournalMail ($name,$password)));*/
        dd($request->all());
        $request->validate([
            'cn_title' => 'required',
            'name' => 'required',
            'contact_type' => 'required',
            'sb_code' => 'required',
            'phone' => 'required',
            'phone' => 'required',
            'phone' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("research");
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['name'])
        ]);
    }


}
