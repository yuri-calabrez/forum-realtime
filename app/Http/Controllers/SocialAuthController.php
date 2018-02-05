<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocialAuth;
use App\User;

class SocialAuthController extends Controller
{
    public function redirect(string $provider)
    {
       return \Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        $user = \Socialite::driver($provider)->user();

        $account = SocialAuth
            ::where(['provider' => $provider, 'social_id' => $user->id])
            ->first();

        if($account) {
            auth()->login($account->user);
            return redirect()->to('/');
        }

        $localUser = User::where('email', $user->email)->first();
        if($localUser) {
            return redirect()->to('/');
        }

        $newUser = new User();
        $newUser->name = $user->name;
        $newUser->email = $user->email;
        $newUser->password = bcrypt(str_random(6));
        $newUser->save();

        $socialAccount = new SocialAuth();
        $socialAccount->provider = $provider;
        $socialAccount->social_id = $user->id;
        $socialAccount->user()->associate($newUser);
        $socialAccount->save();

        auth()->login($newUser);
        return redirect()->to('/');
    }
}
