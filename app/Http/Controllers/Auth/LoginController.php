<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\SocialAccount;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use App\Rules\Captcha;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request,$user){
        if(!$user->verified){
            auth()->logout();
            return back()->with('warning','You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }


    //For Facebook login
    public function redirectFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
        $provider = Socialite::driver('facebook')->user();
        $account = SocialAccount::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();

        if ($account){
            $user = $account->user;
        }else{
            $account = new SocialAccount([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook',
            ]);

            $person = User::where('email',$provider->getEmail())->first();
            if (!$person){
                $person = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'verified' => '1'
                ]);
            }
            $account->user()->associate($person);
            $account->save();
            $user = $person;
        }
        auth()->login($user);
        return redirect()->to('/home');
    }

    //For Google

    public function redirectGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        $provider = Socialite::driver('google')->user();
        $account = SocialAccount::where('provider','google')->where('provider_user_id',$provider->getId())->first();

        if ($account){
            $user = $account->user;
        }else{
            $account = new SocialAccount([
                'provider_user_id' => $provider->getId(),
                'provider' => 'google',
            ]);

            $person = User::where('email',$provider->getEmail())->first();
            if (!$person){
                $person = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'verified' => '1'
                ]);
            }
            $account->user()->associate($person);
            $account->save();
            $user = $person;
        }
        auth()->login($user);
        return redirect()->to('/home');
    }

    //For Twitter

    public function redirectTwitter(){
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback(){
        $provider = Socialite::driver('twitter')->user();
        $account = SocialAccount::where('provider','twitter')->where('provider_user_id',$provider->getId())->first();

        if ($account){
            $user = $account->user;
        }else{
            $account = new SocialAccount([
                'provider_user_id' => $provider->getId(),
                'provider' => 'twitter',
            ]);

            $person = User::where('email',$provider->getEmail())->first();
            if (!$person){
                $person = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'verified' => 1,
                ]);
            }
            $account->user()->associate($person);
            $account->save();
            $user = $person;
        }
        auth()->login($user);
        return redirect()->to('/home');
    }
}
