<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\UserRegisteredSuccessfully;
use App\Rules\EmailDomain;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('showResendVerificationEmailForm','resendVerificationEmail','activateUser');
    }

    /**
     * Register new account.
     *
     * @param Request $request
     * @return User
     */
    protected function register(Request $request)
    {
        /** @var User $user */
        $validatedData = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'    => ['required','string', 'email', 'max:255', 'unique:users', new EmailDomain],
            'password' => 'required|string|min:6|confirmed',
        ]);
        try {
            $validatedData['password']        = bcrypt(array_get($validatedData, 'password'));
            $validatedData['activation_code'] = str_random(30).time();
            $user                             = app(User::class)->create($validatedData);
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect()->back()->with('message', 'Unable to create new user.');
        }
        $user->notify(new UserRegisteredSuccessfully($user));
        return redirect()->back()->with('success', 'Successfully created a new account. Please check your email and activate your account.');
    }
    /**
     * Activate the user with given activation code.
     * @param string $activationCode
     * @return string
     */
    public function activateUser(string $customer, string $activationCode)
    {
        try {
            $user = User::where('activation_code', $activationCode)->first();
            if (!$user) {
                return "The code does not exist for any user in our system.";
            }
            $user->status = 1;
            $user->activation_code = null;
            $user->save();
            auth()->login($user);
        } catch (\Exception $exception) {
            logger()->error($exception);
            return "Whoops! something went wrong.";
        }
        return redirect()->to('/');
    }

    public function showResendVerificationEmailForm(){
        return view('auth.resend');
    }

    public function resendVerificationEmail(Request $request){
        $validatedData = $request->validate([
            'email'    => ['required','string', 'email', 'max:255'],
        ]);

        $validatedData['activation_code'] = str_random(30).time();

        if(User::where('email',$validatedData['email'])->exists()){
            $user = User::where('email',$validatedData['email'])->first();
            $user->activation_code = $validatedData['activation_code'];
            $user->save();
            $user->notify(new UserRegisteredSuccessfully($user));

            return redirect()->back()->with('success', 'If the email exists in our database, we\'ll send you a verification link.');
        }else{
            return redirect()->back()->with('success', 'If the email exists in our database, we\'ll send you a verification link.');
        }
    }
}
