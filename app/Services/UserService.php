<?php

namespace App\Services;

use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function auth(array $creds)
    {
        if (!Auth::attempt($creds)) return self::failedAuth();

        return new UserResource(Auth::user());
    }

    private static function failedAuth()
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Неверный логин или пароль'
        ]));
    }

    public static function successLogout()
    {
        return response()->json([
            'success' => true,
            'error-code' => 0,
            'message' => 'Logging out was successful'
        ]);
    }

    public static function createUser(array $data): User
    {
        $api_token = uniqid('', true);
        $data = array_merge($data, [
            'api_token' => $api_token,
            'password' => Hash::make($data['password'])
        ]);

        return User::create($data);
    }

    public static function updateUser(User $user)
    {

    }

    public static function deleteUser(User $user)
    {

    }
}
