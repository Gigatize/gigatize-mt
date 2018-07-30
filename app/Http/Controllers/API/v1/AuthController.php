<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Resources\UserResource;
use App\Notifications\UserRegisteredSuccessfully;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller {

    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password'); // grab credentials from the request
        try {
            if (!$token = JWTAuth::attempt($credentials)) { // attempt to verify the credentials and create a token for the user
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500); // something went wrong whilst attempting to encode the token
        }

        return response()->json(['token' => "Bearer $token"]);
    }

    public function register(RegisterFormRequest $request)
    {
        try {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->activation_code = str_random(30).time();
            $user->save();
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect()->back()->with('message', 'Unable to create new user.');
        }

        $user->notify(new UserRegisteredSuccessfully($user));
        return new UserResource($user);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ( ! $token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        return response([
            'status' => 'success'
        ])
            ->header('Authorization', $token);
    }

    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate(true);
    }

    /**
     * Activate the user with given activation code.
     * @param string $activationCode
     * @return string
     */
    public function activateUser(string $activationCode)
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
            return response([
                'status' => 'error',
                'msg' => 'Whoops! something went wrong.'
            ], 500);
        }
        return response([
            'status' => 'success',
            'msg' => 'Successfully verified email'
        ], 200);
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

            return response([
                'status' => 'success',
                'msg' => 'If the email exists in our database, we\'ll send you a verification link.'
            ], 200);

        }else{
            return response([
                'status' => 'success',
                'msg' => 'If the email exists in our database, we\'ll send you a verification link.'
            ], 200);
        }
    }
}
?>