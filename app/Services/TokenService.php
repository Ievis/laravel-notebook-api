<?php

namespace App\Services;

use App\Exceptions\AuthorizeAPIToken;
use App\Exceptions\Unauthorized;
use App\Models\NotebookRecord;
use App\Models\User;

class TokenService
{
    public static function getToken()
    {
        return request()->bearerToken();
    }

    public static function ensureIsActionAuthorized(NotebookRecord $record)
    {
        $user = $record->user()->first();
        self::authorizeUserByAPIToken($user);
    }

    public static function authorizeUserByAPIToken(?User $user)
    {
        $token = self::getToken();
        $user_id = empty($user) ? 0 : $user->id;

        if (self::getUserIdByToken($token) !== $user_id) throw new AuthorizeAPIToken();
    }

    public static function getUserIdByToken($token)
    {
        $user = User::where('api_token', $token)->first();

        return empty($user) ? 0 : $user->id;
    }

    public static function getUserByToken()
    {
        $token = self::getToken();

        return User::findOrFail(self::getUserIdByToken($token));
    }
}
