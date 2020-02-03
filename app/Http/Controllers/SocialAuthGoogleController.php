<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;
use Exception;

class SocialAuthGoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {

            $user      = Socialite::driver('google')->stateless()->user();
            $existUser = User::where('email',$user->email)->first();
            $splitName = explode(' ', $user->name); 
            $firstname = $splitName[0];
            $lastname  = !empty($splitName[1]) ? $splitName[1] : ''; 

            if ($existUser) {

                Auth::loginUsingId($existUser->id);
            } else {

                $add_user = new User;
                $add_user->first_name = $firstname;
                $add_user->last_name = $lastname;
                $add_user->email = $user->email;
                $add_user->social_id = $user->id;
                $add_user->save();
                Auth::loginUsingId($add_user->id);
            }

            return redirect()->to('/');
        }  catch (Exception $e) {
            return 'error $e';
        }
    }
}