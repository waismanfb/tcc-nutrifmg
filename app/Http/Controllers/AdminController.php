<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listAdmins()
    {
        $admins = User::where('id', '!=', Auth::user()->id)->get();
        return view('admin', compact('admins'));
    }

    public function deleteAdmins()
    {
        $id  = $_POST['id'];
        DB::table('users')->where('id', '=', $id)->delete();
    }
}
