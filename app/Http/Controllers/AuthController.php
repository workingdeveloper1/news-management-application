<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Models\User;
use App\Repositories\AuthRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseFormatter;
use App\Helpers\ValidatorHelper;

class AuthController extends Controller
{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request){
        $validator = ValidatorHelper::makeLoginValidator($request);

        if ($validator->fails()) {
            return ResponseFormatter::error(null, "Unprocessable Entity", 422, $validator->errors());
        }

        $validatedData = $validator->validated();

        if(!Auth::attempt($validatedData)){
            return ResponseFormatter::error(null, 'Unauthorized', 401, 'Unauthorized');
        }

        $user = $request->user();

        $tokenArray = AuthHelper::createToken($user);

        // $token->save();
        $this->authRepository->saveToken($tokenArray["token"]);

        $data = [
            'access_token' => $tokenArray["resultToken"]->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenArray["token"]->expires_at
            )->toDateTimeString()
            ];

        return ResponseFormatter::success($data, 'Login Success');
    }

    public function register(Request $request){
        $validator = ValidatorHelper::makeRegisterValidator($request);

        if ($validator->fails()) {
            return ResponseFormatter::error(null, "Unprocessable Entity", 422, $validator->errors());
        }

        $validatedData = $validator->validated();

        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = $this->authRepository->register($validatedData);

        return ResponseFormatter::success($user, 'Successfully created user!', 201);
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();

        return ResponseFormatter::success(null, 'Successfully logged out!');
    }
}
