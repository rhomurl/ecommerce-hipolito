<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
//use Hash;
//use Validator;
use Exception;
use Socialite;
use Auth;

class LoginController extends Controller
{

    public function redirectToProvider(Request $request, $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        $user = Socialite::driver($provider)->user();
        $auth_user = $this->findOrCreateUser($user, $provider);
        
       // $auth_user->assignRole('customer');

        Auth::login($auth_user, true);

        if ( auth()->user()->hasAnyRole(['super-admin', 'admin']) ) {
            return redirect('/admin');
        }
        return redirect()->intended(route('home'));
    }

    public function findOrCreateUser($user, $provider)
    {
        
        $authUser = User::where('email', $user->email)->first();

        if ($authUser) {
            return $authUser;
        }

        try 
        {    
            $newUser = User::create([
                'email' => $user->email,
                'name' => $user->name,
                'provider' => $provider,
                'provider_id' => $user->id,
            ]);

            return $newUser->assignRole('customer');


        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    
    /*
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    
    public function handleGoogleCallback()
    {
        try {
            //create a user using socialite driver google
            $user = Socialite::driver('google')->user();
            // if the user exits, use that user and login
            $finduser = User::where('provider_id', $user->id)->first();
            if($finduser){
                //if the user exists, login and show dashboard
                Auth::login($finduser);
                return redirect('/');
            }
            else{
                //Create new user
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider' => 'google',
                    'provider_id' => $user->id,
                ]);

                $newUser->assignRole('customer');
                //login as the new user
                Auth::login($newUser);
                
                // go to the dashboard
                return redirect('/');
            }
            //catch exceptions
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function handleFacebookCallback()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            $userCol = User::where('fbid', $user->id)->first();
     
            if($userCol){
                Auth::login($userCol);
                return redirect('/');
            }else{
                $addUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fbid' => $user->id,
                ]);
    
                Auth::login($addUser);
                return redirect('/');
            }
    
        } catch (Exception $exception) {
            
            dd($exception->getMessage());
        }
    }
    */
    
}
