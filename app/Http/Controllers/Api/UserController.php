<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSignup as UserSignupRequest;
use App\Http\Requests\UserLogin as UserLoginRequest;
use App\Repositories\UserRepository;
use App\Services\Auth\ApiAuth;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 *
 */
class UserController extends Controller
{

    public function signup(UserSignupRequest $request, UserRepository $repository)
    {

        $user = $repository->create($request->username, $request->password);

        //TODO make resource
        return $user;
    }

    public function login(UserLoginRequest $request, UserRepository $repository, ApiAuth $apiAuth)
    {
        if ( $user = $repository->verifyPassword($request->username, $request->password) ) {
            $token = $apiAuth->make($user);

            //TODO make resource
            return [
                'token' => $token,
                'user' => $user,
            ];
        }

        //TODO make custom exception
        throw new \Exception("Login can not be done.");
    }

}
