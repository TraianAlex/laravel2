<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Input;
use Validator;
use Redirect;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function getSignIn()
    {
        return view('account.signin');
    }

    public function postSignIn()
    {
        $validator = Validator::make(Input::all(),
            [
                'email'    => 'required|max:50|email',
                'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return Redirect::route('account-sign-in')->withErrors($validator)->withInput();
        }else{
            $remember = (Input::has('remember')) ? true : false;
            $auth = \Auth::attempt([
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'active' => 1
            ], $remember);
            if ($auth) {
                return Redirect::intended('/')->with('global', 'You sucessfully signed in')
                                              ->with('alert-class', 'alert-info');;
            }else{
                return Redirect::route('account-sign-in')
                    ->with('global', 'Email/Password wrong, or account not activated.');
            }
        }
        return Redirect::route('account-sign-in')
            ->with('global', 'There is a problem signing you in.');
    }

    public function getSignOut()
    {
        \Auth::logout();
        return Redirect::route('home')->with('global', 'You sucessfully signed out')
                                      ->with('alert-class', 'alert-danger');
    }
    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('account.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        $validator = Validator::make(Input::all(),
            [
                'email'    => 'required|max:50|email|unique:users',
                'username' => 'required|between:3,20|alpha_num|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return Redirect::route('account-create')->withErrors($validator)
                                                    ->withInput(Input::except('password'));
        }else{
            $code = str_random(60);
            $create = User::create([
                'email' => Input::get('email'),
                'username' => Input::get('username'),
                'password' => bcrypt(Input::get('password')),
                'code' => $code,
                'active' => 0
            ]);
            if ($create) {
                \Mail::send('email.activate',
                           ['username' => $create->username,
                           'link' => \URL::route('account-activate', $code)],
                           function ($m) use ($create) {
                                $m->from('victortraian92@gmail.com', 'Embassy Pub');
                                $m->to($create->email, $create->username)
                                  ->subject('Activate your account');
                           }
                );
                return Redirect::route('home')
                    ->with('global', 'Your account has been created! 
                        We have sent you an email to activate your account.');
            }
        }
    }

    public function getActivate($code){

        $user = User::where('code', '=', $code)->where('active', '=', 0);
        if ($user->count()) {
            $user = $user->first();
            $user->active = 1;
            $user->code = '';
            if ($user->save()) {
                return Redirect::route('home')
                    ->with('global', 'Activated! You can now sign in!');
            }
        }
        return Redirect::route('home')
                ->with('global', 'We could not activate your account. Try again later.');
    }

    public function getChangePassword(){
        return view('account.password');
    }

    public function postChangePassword(){
        $validator = Validator::make(Input::all(),
            [
                'old_password' => 'required|min:6',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return Redirect::route('account-change-password')->withErrors($validator);
        }else{
            $user = User::find(\Auth::user()->id);
            if (\Hash::check(Input::get('old_password'), $user->getAuthPassword())) {
                $user->password = bcrypt(Input::get('password'));
                if($user->save()){
                    return Redirect::route('home')
                            ->with('global', 'Your password has been changed.');
                }
            }else{
                 return Redirect::route('account-change-password')
                        ->withErrors(['old_password' => 'Your old password in incorect.']);
            }
        }
        return Redirect::route('account-change-password')
                ->with('global', 'Your password could not be changed. Try again later.s');
    }

    public function getForgotPassword()
    {
        return view('account.forgot');
    }

    public function postForgotPassword()
    {
       $validator = Validator::make(Input::all(),
            [
                'email'    => 'required|max:50|email',
        ]);
        if ($validator->fails()) {
            return Redirect::route('account-forgot-password')
                    ->withErrors($validator)->withInput();
        }else{
            $user = User::where('email', '=', Input::get('email'));
            if ($user->count()) {
                $user = $user->first();
                $code = str_random(60);
                $password = str_random(10);
                $user->code = $code;
                $user->password_temp = bcrypt($password);
                if ($user->save()) {
                    \Mail::send('email.forgot',
                                ['username' => $user->username,
                                 'link' => \URL::route('account-recover', $code),
                                 'password' => $password],
                                function ($m) use ($user) {
                                    $m->from('victortraian92@gmail.com', 'Embassy Pub');
                                    $m->to($user->email, $user->username)
                                      ->subject('Your new password');
                                }
                    );
                    return Redirect::route('home')
                            ->with('global', 'We have sent you a new password by email');
                }
            }
        }
        return Redirect::route('account-forgot-password')
                ->withErrors(['email' => 'Could not request new password']);
    }

    public function getRecover($code)
    {
        $user = User::where('code', '=', $code)->where('password_temp', '!=', '');
        if ($user->count()) {
            $user = $user->first();
            $user->password = $user->password_temp;
            $user->password_temp = '';
            $user->code = '';
            if ($user->save()) {
                return Redirect::route('home')
                        ->with('global', 'Your account has been recovered and you can 
                                            sign in with your new password');
            }
        }
        return Redirect::route('home')->with('global', 'Could not recover your account.');
    }
    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
