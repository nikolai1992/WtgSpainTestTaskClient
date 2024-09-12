<?php

namespace App\Trait;

use App\Services\WTGApiServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RedirectsUsers;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $wtgApiService = app(WTGApiServices::class);
        $result = $wtgApiService->registerUser(
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password'),
            passwordConfirm: $request->input('password_confirmation'),
        );

        if ($result) {
            return redirect()->route('login');
        } else {
            return redirect()->route('register');
        }
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
