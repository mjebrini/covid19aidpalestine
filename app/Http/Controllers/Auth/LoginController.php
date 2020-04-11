<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\User;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Redirect To Provider
     *
     * @var object $provider
     */
    public function redirectToProvider($provider)
    {
       return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle Provider Callback
     *
     * @var object $provider
     */
    public function handleProviderCallback($provider)
    {
       try {
           $user = Socialite::driver($provider)->user();
       } catch (Exception $e) {
           return redirect('/login');
       }

       $authUser = $this->checkUser($user, $provider);

       Auth::login($authUser, true);

       return redirect($this->redirectTo);
    }

    /**
     * Check User Authentication:
     * Check validate data and create new record if it is not existing
     *
     * @var string $providerUser
     * @var string $provider
     * @return object
     */
    public function checkUser($providerUser, $provider)
    {
        $account = User::where('provider_name', $provider)
                    ->where('provider_id', $providerUser->getId())
                    ->first();
        if ($account) {

            return $account->user;
        } else {
            $user = User::where('email', $providerUser->getEmail())
            ->first();
            if (! $user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name'  => $providerUser->getName(),
                    'provider_id'   => $providerUser->getId(),
                    'provider_name' => $provider,
                ]);
            }

            return $user;
        }
    }

    
}
