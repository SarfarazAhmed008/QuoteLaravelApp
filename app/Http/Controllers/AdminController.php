<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;

use App\Author;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
	public function getLogin()
	{
		if(Auth::check()){
			return redirect()->back();
		}
		return view('admin.login');
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect()->route('home');
	}

	public function getDashboard()
	{
		if (!Auth::check()){
			return redirect()->back();
		}
		$authors = Author::all();
		return view('admin.dashboard', ['authors' => $authors]);
	}

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'password' => 'required'
		]);

		if (!Auth::attempt(['name' => $request['name'], 'password' => $request['password']])){
			return redirect()->back()->with(['fail' => 'Incorrect login credentials !']);
		}
		return redirect()->route('admin.dashboard');
	}

	


}