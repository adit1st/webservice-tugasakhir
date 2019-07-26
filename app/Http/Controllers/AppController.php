<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AppController extends Controller
{
    public function init()
    {
    	$user = Auth::user();

    	return response()->json($user, 200);
    }

    public function login(request $request)
    {
    	if (Auth::attempt(['username'=>$request->username, 'password'=>$request->password], true))
    	{
    		return respone()->json(Auth::user(), 200);
    	}
    	else {
    		return response()->json(['error'=>'Anda tidak bisa login.'], 401);
    	}
    }

    public function register(request $request)
    {
    	$user = User::where('username', $request->username)->first();

    	if (isset($user->id))
    	{
    		return response()->json(['error'=>'Username sudah digunakan.'], 401);
    	}

    	$user = new User();

    	$user->username = $request->username;
    	$user->password = bcrypt($request->password);
    	$user->save();

    	Auth::login($user);

    	return response()->json($user, 200);
    }

    public function logout()
    {
    	Auth::logout();
    }
}
