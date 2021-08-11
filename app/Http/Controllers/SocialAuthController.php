<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\Models\User;

class SocialAuthController extends Controller
{

    public function redirect($driver)
    {
        session(['driver' => $driver]);
        return Socialite::driver($driver)->with(['driver' => $driver])->redirect();
    }

    public function callback()
    {
        $driver = session()->get('driver');
        try {
            $socialUser = Socialite::driver($driver)->user();
            $driver_id = $driver. '_id';
            $user = User::where($driver_id, $socialUser->id)->first();
            if ($user) {
                Auth::login($user);
                return redirect('/');
            } else {
                $createUser = User::create([
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'github_id' => $socialUser->id,
                    'password' => encrypt('123456')
                ]);

                Auth::login($createUser);
                return redirect('/');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
