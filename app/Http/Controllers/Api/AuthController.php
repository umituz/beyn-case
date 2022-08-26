<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\User\UserV1Resource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->error(__('Email or password is incorrect!'));
        }

        if (!$token = Auth::user()->createToken($request->email)->plainTextToken) {
            return $this->error(__('Failed to create token!'));
        }

        Auth::user()->access_token = $token;

        return $this->success(__('Success'), UserV1Resource::make(Auth::user()));
    }

    /**
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if (!$user) {
            return $this->error(__('User failed to register!'));
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->error(__('Login failed'));
        }

        if (!$token = Auth::user()->createToken($request->email)->plainTextToken) {
            return $this->error(__('Failed to create token!'));
        }

        $user->access_token = $token;

        return $this->success(__('Success'), UserV1Resource::make($user));
    }

    /**
     * @return array
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => __('Logged Out')
        ];
    }
}
