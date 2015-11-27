<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Mail;

class HomeController extends Controller
{
	public function home(){

		//$user = User::find(1)->username;
		// Mail::send('email.test', ['name' => 'Alex'], function($message){
		// 	$message->from('victortraian92@gmail.com', 'Embassy Pub');
		// 	$message->to('victor_traian@yahoo.com', 'Traian')->subject('test email');
		// });
		// Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
  //           $m->to($user->email, $user->name)->subject('Your Reminder!');
  //       });
		return view('home');
	}

/***************************************************************************************/

    public function showWelcome()
	{
		return view('hello2');
	}

	public function showAbout()
	{
		return 'About Us';
	}
}
