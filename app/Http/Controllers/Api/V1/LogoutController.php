<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TokenService;
use App\Services\UserService;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = TokenService::getUserByToken();
        $this->updateAPIToken($user);

        return UserService::successLogout();
    }

    private function updateAPIToken(User $user)
    {
        $user->update([
            'api_token' => uniqid('', true)
        ]);
    }
}
