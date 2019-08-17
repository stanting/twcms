<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordUpdate;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.my.password.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PasswordUpdate $request)
    {
        $user = $request->user();
        $user->password = Hash::make($request->newpw);
        $user->save();
        
        Auth::guard()->login($user);
        
        return response()->json([
            'err' => 0,
            'msg' => '修改成功',
        ]);
    }
}
