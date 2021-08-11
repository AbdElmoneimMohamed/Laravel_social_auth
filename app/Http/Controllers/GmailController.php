<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\Models\User;

class GmailController extends Controller
{
    public function redirectToGmail()
    {
        return Socialite::driver('google')->redirect();
    }

    public function gmailSignin()
    {
        try {
            $gmailUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $gmailUser->id)->first();
            if ($user) {
                Auth::login($user);
                return redirect('home');
            } else {
                $createUser = User::create([
                    'name' => $gmailUser->name,
                    'email' => $gmailUser->email,
                    'google_id' => $gmailUser->id,
                    'password' => encrypt('123456')
                ]);

                Auth::login($createUser);
                return redirect('home');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
