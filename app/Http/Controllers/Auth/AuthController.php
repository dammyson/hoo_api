<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Http\Requests\Auth\CreateRequest;
use App\Http\Requests\Auth\CreateSmsRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Services\User\RegistrationService;
use App\Http\Resources\UserResource;
use App\Models\Otp;
use App\Services\User\ForgetPassword;
use App\Support\Enum\UserStatus;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Services\Profile\UpdatePassword;
use App\Services\User\CreateOtpService;
use App\Services\User\SMSService;
use App\Support\Enum\ClassMessages;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * Create a new authentication controller instance.
     * @param UserRepository $users
     */

    public function create(CreateRequest $request)
    {
        $validated = $request->validated();
        try {
            $new_user = new RegistrationService($validated);
            $registered_user = $new_user->run();
            $token = $registered_user->createToken($validated['email'])->accessToken;
           // $user = new UserResource($registered_user);
            return response()->json(['status' => true, 'data' => $registered_user , 'token' => $token,  'message' => 'registration successful'], 201);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['status' => false,  'message' => 'Error processing request'], 500);
        }
    }




      /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(LoginRequest $request)
    {
        $validated = $request->validated();
        if (auth()->attempt(['email' =>  $validated['email'], 'password' =>  $validated['password']])) {
            $user = Auth::user();
            $token = $user->createToken($validated['email'])->accessToken;
            $user->last_login = \Carbon\Carbon::now();
            $user->save();
            return response()->json(['status' => true, 'message' => 'Login successful','token' => $token, 'data' => $user ], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'UnAuthorised'], 401);
        }
    }

    public function SendSms(CreateSmsRequest $request)
    {
        $validated = $request->validated();
        try {
            $new_otp = new CreateOtpService($validated);
            $new_otp = $new_otp->run();
            $msg='Dear customer, use this One Time Password ' .  $new_otp->otp. ' to log in to your (House of Oni) account. This OTP will be valid for the next 2 hrs.';
            $sms = new SMSService($msg, $new_otp->phone_number);
            $new_sms = $sms ->run();
            return response()->json(['status' => true, 'data' => $new_sms, 'message' => 'sms sent successfully'], 201);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['status' => false,  'message' => $exception->getMessage()], 500);
        }
    }


    public function VerifySms(VerifyOtpRequest $request)
    {
        $validated = $request->validated();
        try {
            $model = Otp::where('phone_number', '=', $validated['phone_number']) 
            ->where('otp', '=', $validated['otp'])
            ->firstOrFail();
            return response()->json(['status' => true, 'data' => $model, 'message' => 'Verified successfully'], 201);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['status' => false,  'message' => $exception->getMessage()], 500);
        }
    }

}
