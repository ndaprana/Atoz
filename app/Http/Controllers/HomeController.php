<?php

namespace App\Http\Controllers;

use App\Home;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Input;
use Validator;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@index');
	|
	*/

	public function index()
	{

		$data['user'] = Auth::user();

		return view('home')->with($data);

	}

	public function login()
	{
        if(Auth::id()) return redirect( '/');

		return view('login');
	}

	public function register()
	{
        if(Auth::id()) return redirect( '/');

		return view('register');
	}

	public function profile()
	{
        if(!Auth::id()) return redirect( '/');

		$data['user'] = Auth::user();

		return view('profile')->with($data);
	}

	public function user()
	{
        if(!Auth::id()) return redirect( '/');

        $data['users'] = User::getUser();
		$data['user'] = Auth::user();

		return view('table')->with($data);
	}

	public function useradd()
	{
        if(!Auth::id()) return redirect( '/');

        $data['users'] = User::getUser();
		$data['user'] = Auth::user();

		return view('create')->with($data);
	}

	public function useredit($id)
	{
        if(!Auth::id()) return redirect( '/');


        $data['users'] = User::getUser();
		$data['user'] = Auth::user();
		$data['edit'] = User::find($id);

		return view('edit')->with($data);
	}

	public function edituser()
	{
        if(!Auth::id()) return redirect( '/');

        $data['users'] = User::getUser();
		$data['user'] = Auth::user();

		$rules = array(
			'name'       => 'required',
			'email'      => 'required|email',
            'password' => 'required|confirmed|min:6',
		);
		$validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
			return redirect('user/edit/'.Input::get('id'))
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$user = User::find(Input::get('id'));
			$user->name       = Input::get('name');
			$user->password = bcrypt(Input::get('password'));
			$user->save();
			// redirect
			session('message', 'Successfully created user!');
			return redirect('/user');
		}

	}

	public function actuser($id)
	{
        if(!Auth::id()) return redirect( '/');

        User::actUser($id);

		return redirect( '/user');
	}

	public function inactuser($id)
	{
        if(!Auth::id()) return redirect( '/');

        User::inactUser($id);

		return redirect( '/user');
	}	

	public function deluser($id)
	{
        if(!Auth::id()) return redirect( '/');

        User::delUser($id);

		return redirect( '/user');
	}	

}